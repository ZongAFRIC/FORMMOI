<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Formation;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ('Les formations test');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorie = Categorie::all();
        return view('formation.creerformation', compact('categorie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string',
            'description' => 'required|string',
            'duree' => 'required|integer',
            'prix' => 'required|numeric',
            'video' => 'nullable|file|mimes:mp4,mkv',
            'pdf' => 'nullable|file|mimes:pdf',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
    
        \Log::info('Validation passed');
    
        try {
            // Initialisation des chemins de fichiers et noms de fichiers
            $videoPath = null;
            $pdfPath = null;
            $imagePath = null;
    
            // Uploader les fichiers dans les répertoires personnalisés et enregistrement des noms originaux
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = $video->getClientOriginalName();
                $videoPath = $video->storeAs('formation/video', $videoName,'public'); // Stockage dans le répertoire
                // $videoPath = $videoName; // Enregistrement du nom du fichier en base de données
            }
    
            if ($request->hasFile('pdf')) {
                $pdf = $request->file('pdf');
                $pdfName = $pdf->getClientOriginalName();
                $pdfPath = $pdf->storeAs('formation/pdf', $pdfName,'public'); // Stockage dans le répertoire
                // $pdfPath = $pdfName; // Enregistrement du nom du fichier en base de données
            }
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();
                $imagePath = $image->storeAs('formation/image', $imageName,'public'); // Stockage dans le répertoire
                // $imagePath = $imageName; // Enregistrement du nom du fichier en base de données
                // $imagePath = $file->storeAs('etudiant/image', $filename,'public');
            }
    
            // \Log::info('Files uploaded', ['video' => $videoPath, 'pdf' => $pdfPath, 'image' => $imagePath]);
    
            // Récupération du formateur authentifié
            $formateur = Auth::guard('formateur')->user();
            if (!$formateur) {
                // \Log::error('Formateur not authenticated');
                return redirect()->back()->withErrors(['error' => 'Formateur non authentifié']);
            }
    
            // \Log::info('Formateur authenticated', ['id' => $formateur->id]);
    
            // Création de la formation
            $formation = Formation::create([
                'titre' => $request->titre,
                'categorie' => $request->categorie,
                'description' => $request->description,
                'duree' => $request->duree,
                'video' => $videoPath, 
                'pdf' => $pdfPath,     
                'image' => $imagePath,  
                'prix' => $request->prix,
                'formateur_id' => $formateur->id,
            ]);
    
            // \Log::info('Formation created successfully', ['id' => $formation->id]);
    
            return redirect()->route('formateur.mes-formations')->with('success', 'Formation créée avec succès.');
    
        } catch (\Exception $e) {
            // \Log::error('Error creating formation', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la création de la formation.']);
        }
    }
    
    // Méthode d'upload pour la formation
    private function uploadFile($file, $directory)
    {
        return $file->store($directory, 'public');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formation = Formation::findOrFail($id);
        $formation = Formation::with('chapitres')->findOrFail($id);
        $nombreChapitres = $formation->chapitres->count();
        return view('formation.formationshow', compact('formation', 'nombreChapitres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formation = Formation::findOrFail($id);
        $categorie = Categorie::all();
        return view('formation.formationedit', compact('formation','categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'categorie' => 'sometimes|required|string',
            'duree' => 'sometimes|required|integer',
            'prix' => 'sometimes|required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|file|mimes:pdf',
            'video' => 'nullable|file|mimes:mp4,avi,mkv',
        ]);

        // $formateur = Auth::guard('formateur')->user();
        $formation = Formation::findOrFail($id);

        if ($request->has('titre')) {
            $formation->titre = $request->titre;
        }
        if ($request->has('description')) {
            $formation->description = $request->description;
        }
        if ($request->has('categorie')) {
            $formation->categorie = $request->categorie;
        }
        if ($request->has('duree')) {
            $formation->duree = $request->duree;
        }
        if ($request->has('prix')) {
            $formation->prix = $request->prix;
        }
        
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si nécessaire
            if ($formation->image) {
                Storage::disk('public')->delete($formation->image);
            }
            
            // Stocker la nouvelle image
            $path = $request->file('image')->store('formation/image', 'public');
            $formation->image = $path;
        }

        if ($request->hasFile('pdf')) {
            // Supprimer l'ancienne pdf si nécessaire
            if ($formation->pdf) {
                Storage::disk('public')->delete($formation->pdf);
            }
            
            // Stocker la nouvelle pdf
            $path = $request->file('pdf')->store('formation/pdf', 'public');
            $formation->pdf = $path;
        }

        if ($request->hasFile('video')) {
            // Supprimer l'ancienne video si nécessaire
            if ($formation->video) {
                Storage::disk('public')->delete($formation->video);
            }
            
            // Stocker la nouvelle video
            $path = $request->file('video')->store('formation/video', 'public');
            $formation->video = $path;
        }

        $formation->save();

        return redirect()->route('formation.detail', ['id' => $formation->id])->with('success', 'Formation mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return redirect()->route('formateur.mes-formations')->with('success', 'Formation supprimé avec succès.');
    }

    public function publier($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->published = true;
        $formation->save();

        return redirect()->back()->with('success', 'Formation publiée avec succès !');
    }

    public function depublier($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->published = false;
        $formation->save();

        return redirect()->back()->with('success', 'Formation dépubliée avec succès !');
    }


    public function listFormation()
    {
        $etudiant = auth('etudiant')->user();

        // Formations non achetées
        $formation = Formation::whereDoesntHave('etudiants', function ($query) use ($etudiant) {
            $query->where('etudiant_id', $etudiant->id);
        })->get();
        return view('formation.list', compact('formation'));
    }

    public function detail($formation_id)
    {
        $formation = Formation::with('formateur')->withCount('chapitres')->findOrFail($formation_id);
        return view('etudiant.detail',compact('formation'));
    }

}
