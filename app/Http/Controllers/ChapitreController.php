<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formateur;
use App\Models\Formation;
use App\Models\Chapitre;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create($formationId)
    {
        // $formation = Formation::findOrFail($formationId);
        // $chapitres = $formation->chapitres;

        // return view('formateur.addchapitre', compact('formation', 'chapitres'));
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
            // 'formation_id' => 'required|exists:formations,id',
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,avi,mkv|max=50000',
        ]);
    
        try {
    
            // Uploader les fichiers dans les répertoires personnalisés et enregistrement des noms originaux
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = $video->getClientOriginalName();
                $videoPath = $video->storeAs('formation/chapitre/video', $videoName,'public'); // Stockage dans le répertoire
            }
    
            \Log::info('Files uploaded', ['video' => $videoPath]);
        
            // Création de la formation
            $chapitre = Chapitre::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'video' => $videoPath, 
                'formation_id' => $formation->id,
            ]);
    
            \Log::info('Chapitre added successfully', ['id' => $chapitre->id]);
    
            return redirect()->route('formation.addchapitre', ['id' => $chapitre->id])->with('success', 'Chapitre mise à jour avec succès.');
    
        } catch (\Exception $e) {
            \Log::error('Error adding chapiter', ['error' => $e->getMessage()]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        return view('formation.capitre.edit', compact('chapitre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'video' => 'sometimes|required|file|mimes:mp4,avi,mkv|max:50000',
        ]);

        $chaiptre = Chapitre::findOrFail($id);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $chapitre->delete();
        return redirect()->back()->with('success', 'Chapitre supprimé avec succès.');
    }

     
}
