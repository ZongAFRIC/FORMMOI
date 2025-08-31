<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Formation;
use App\Models\Chapitre;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChapitreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        // $formation = Formation::findOrFail($id);
        // $chapitre = Chapitre::all();
        // return view('formateur.addchapitre', compact('chapitre'));
    }

    public function afficherChapitres($formationId)
    {
        $formation = Formation::findOrFail($formationId);
        $chapitre = $formation->chapitres;
        
        return view('formateur.addchapitre', compact('formation', 'chapitre'));
    }


    public function ajoutChapitre(Request $request, $formationId)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,mkv,avi|max:50000',
        ]);

        $video = $request->file('video');
        $videoName = $video->getClientOriginalName();
        $videoPath = $video->storeAs('formation/chapitre/video', $videoName,'public'); // Stockage dans le répertoire
        Chapitre::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'video' => $videoPath,
            'formation_id' => $formationId,
        ]);

        return redirect()->route('chapitre.ajout', ['formationId' => $formationId])->with('success', 'Chapitre ajouté avec succès !');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $formationId)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,avi,mkv|max:512000', // 500 Mo
        ]);
    
        try {
    
            // Uploader les fichiers dans les répertoires personnalisés et enregistrement des noms originaux
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = $video->getClientOriginalName();
                $videoPath = $video->storeAs('formation/chapitre/video', $videoName,'public'); // Stockage dans le répertoire
            }
    
            Log::info('Files uploaded', ['video' => $videoPath]);
        
            // Création de la formation
            $chapitre = Chapitre::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'video' => $videoPath, 
                'formation_id' => $formation->id,
            ]);
    
            Log::info('Chapitre added successfully', ['id' => $chapitre->id]);
            
            return redirect()->route('formation.addchapitre', ['id' => $chapitre->id])->with('success', 'Chapitre mise à jour avec succès.');
    
        } catch (\Exception $e) {
            Log::error('Error adding chapiter', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l"ajout du chapitre.']);
        }
    }

    private function uploadFile($file, $directory)
    {
        return $file->store($directory, 'public');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        return view('formation.chapitre.show', compact('chapitre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editChapitre(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        return view('formation.editChapitre', compact('chapitre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'video' => 'sometimes|required|file|mimes:mp4,avi,mkv|max:512000',
        ]);

        $chapitre = Chapitre::findOrFail($id);

        if ($request->has('titre')) {
            $chapitre->titre = $request->titre;
        }
        if ($request->has('description')) {
            $chapitre->description = $request->description;
        }
        if ($request->hasFile('video')) {
            // Supprimer l'ancienne video si nécessaire
            if ($chapitre->video) {
                Storage::disk('public')->delete($chapitre->video);
                
            }
            
            // Stocker la nouvelle video
            $path = $request->file('video')->store('formation/chapitre/video', 'public');
            $chapitre->video = $path;
        }

        $chapitre->save();

        return redirect()->route('formation.chapitre.show', ['id' => $chapitre->id])->with('success', 'Chapitre mise à jour avec succès.');

    }

    public function formationChapitres($formationId)
    {
        $formation = Formation::findOrFail($formationId);
        $chapitres = $formation->chapitres;

        return view('formation.chapitre.index', compact('formation', 'chapitres'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $chapitre->delete();
        return redirect()->back()->with('success', 'Chapitre supprimé avec succès.');
    }

    public function noter(Request $request, $chapitreId)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
        ]);

        Avis::create([
            'note' => $request->note,
            'commentaire' => null,
            'type' => 'Note',
            'chapitre_id' => $chapitreId,
            'utilisateur_id' => auth()->id(),
            'type_utilisateur' => auth()->guard('formateur')->check() ? 'formateur' : 'etudiant',
        ]);

        return back()->with('success', 'Votre note a été enregistrée.');
    }

    public function commenter(Request $request, $chapitreId)
    {
        $request->validate([
            'commentaire' => 'required|string|min:3',
        ]);

        Avis::create([
            'note' => null,
            'commentaire' => $request->commentaire,
            'type' => 'Commentaire',
            'chapitre_id' => $chapitreId,
            'utilisateur_id' => auth()->id(),
            'type_utilisateur' => auth()->guard('formateur')->check() ? 'formateur' : 'etudiant',
        ]);

        return back()->with('success', 'Votre commentaire a été ajouté.');
    }

    public function marquerTermine($id) 
    {
        // Récupération de l'utilisateur authentifié
        $user = auth('etudiant')->user() ?? auth('formateur')->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Non authentifié'], 401);
        }

        // Vérifier si le chapitre existe
        $chapitre = Chapitre::find($id);
        if (!$chapitre) {
            return response()->json(['success' => false, 'message' => 'Chapitre introuvable'], 404);
        }

        // Marquer comme terminé
        $chapitreUser = DB::table('chapitre_user')->updateOrInsert(
            [
                'chapitre_id' => $id,
                'user_id' => $user->id,
                'user_type' => get_class($user),
            ],
            ['completed_at' => now()]
        );

        return response()->json(['success' => true, 'message' => 'Chapitre marqué comme terminé']);
    }


     
}

//  Fais moi un roast avec toutes les questions que je t'ai posé jusque là