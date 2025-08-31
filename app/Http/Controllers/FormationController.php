<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Formation;
use App\Models\Formateur;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
    
        Log::info('Validation passed');
    
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

        if ($formation->chapitres()->count() === 0) {
            // Rediriger avec un message d'erreur si aucun chapitre n'est associé
            return redirect()->back()->with('error', 'Impossible de publier la formation car elle ne contient aucun chapitre.');
        }
        
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

        // Formations non achetées et publiées
        $formations = Formation::where('published', true)
            ->whereDoesntHave('etudiants', function ($query) use ($etudiant) {
                $query->where('etudiant_id', $etudiant->id)
                    ->whereHas('paiements', function ($query) {
                        $query->where('status', 'validé'); // Filtrer les paiements validés
                    });
            })
            ->get();

        return view('formation.list', compact('formations'));
    }


    public function detail($formation_id)
    {
        $formation = Formation::with('formateur')->withCount('chapitres')->findOrFail($formation_id);
        return view('pagesCommunes.formationdetail',compact('formation'));
    }

    public function allsFormations()
    {
        $formateur = auth()->guard('formateur')->user();

        // Formations publiées par ce formateur
        $AllFormation = Formation::all();
        $mesformations = $formateur->formations;

        // dd($mesformations);
        $formationsAchetees = $formateur->mesformationsAchetees()->get();
        // dd($formationsAchetees);

        // Toutes les formations publiées (sauf celles du formateur connecté)
        $autresformations = Formation::where('published', true)
            ->whereDoesntHave('formateur', function ($query) use ($formateur) {
                $query->where('formateur_id', $formateur->id)
                    ->whereHas('paiements', function ($query) {
                        $query->where('status', 'validé'); // Filtrer les paiements validés
                    });
            })
            ->get();

        return view('formateur.formations', compact('mesformations', 'formationsAchetees', 'autresformations'));
    }


    public function allFormations()
    {
        $formateur = auth()->guard('formateur')->user();

        // Formations publiées par ce formateur
        $mesformations = $formateur->formations;

        // Formations déjà achetées par ce formateur
        $formationsAchetees = $formateur->mesformationsAchetees()->get();

        // Liste des IDs des formations achetées pour l'exclusion
        $formationsAcheteesIds = $formationsAchetees->pluck('id');

        // Toutes les formations publiées (sauf celles du formateur connecté et celles achetées)
        $autresformations = Formation::where('published', true)
            ->where('formateur_id', '!=', $formateur->id)
            ->whereNotIn('id', $formationsAcheteesIds) // Exclure les formations achetées
            ->get();

        return view('formateur.formations', compact('mesformations', 'formationsAchetees', 'autresformations'));
    }


    public function achat($formation_id)
    {
        $formation = Formation::findOrFail($formation_id);
        return view('pagesCommunes.achat', compact('formation'));
    }


    public function mesCours()
    {
        if ($etudiant = auth('etudiant')->user()) {
            $user = $etudiant;
            $mesFormations = $user->formationsAchetees()->with('chapitres.avis')->get();
        } else {
            $user = auth('formateur')->user();
            $mesFormations = $user->mesformationsAchetees()->with('chapitres.avis')->get();
        }

        $mesformationCount = $mesFormations->count();

        foreach ($mesFormations as $formation) {
            // Moyenne des notes
            $notes = $formation->chapitres->flatMap(fn($chapitre) =>
                $chapitre->avis->whereNotNull('note')->pluck('note')
            );
            $formation->moyenne_notes = $notes->isNotEmpty() ? number_format($notes->avg(), 2) : null;

            // Progression
            $totalChapitres = $formation->chapitres->count();

            $chapitresTermines = DB::table('chapitre_user')
                ->whereIn('chapitre_id', $formation->chapitres->pluck('id'))
                ->where('user_id', $user->id)
                ->where('user_type', get_class($user))
                ->count();

            $progression = $totalChapitres > 0
                ? round(($chapitresTermines / $totalChapitres) * 100)
                : 0;

            $formation->progression = $progression;
            $formation->statut = $progression === 100 ? 'Terminé' : 'En cours';
        }

        return view('pagesCommunes.mesCours', compact('mesFormations', 'mesformationCount'));
    }


    public function monCours($id, Request $request)
    {
        // Identifier l'utilisateur connecté
        $user = auth('etudiant')->user() ?? auth('formateur')->user();

        // Charger la formation avec chapitres
        $formation = Formation::with('chapitres')->findOrFail($id);

    
        $totalChapitres = $formation->chapitres->count();

        $chapitresTermines = DB::table('chapitre_user')
            ->where('user_id', $user->id)
            ->where('user_type', get_class($user))
            ->whereNotNull('completed_at')
            ->whereIn('chapitre_id', $formation->chapitres->pluck('id'))
            ->count();

        $progression = $totalChapitres > 0
            ? round(($chapitresTermines / $totalChapitres) * 100)
            : 0;

        $chapitreActif = null;
        if ($request->has('chapitre_id')) {
            $chapitreActif = Chapitre::where('id', $request->chapitre_id)
                ->where('formation_id', $formation->id)
                ->first();
        }

        if (!$chapitreActif) {
            $chapitreActif = $formation->chapitres->first();
        }

        return view('pagesCommunes.monCours', [
            'formation' => $formation,
            'chapitres' => $formation->chapitres,
            'chapitreActif' => $chapitreActif,
            'progression' => $progression
        ]);
    }



    public function searchCours(Request $request)
    {
        try {
            if (!Auth::guard('etudiant')->check() && !Auth::guard('formateur')->check()) {
                return response()->json(['error' => 'Non authentifié'], 401);
            }

            $query = trim($request->input('recherche', ''));
            if ($query === '') {
                return response()->json([]);
            }

            // Détermine la source des cours selon le rôle
            if (Auth::guard('etudiant')->check()) {
                $user = Auth::guard('etudiant')->user();
                $coursQuery = $user->formationsAchetees();
            } else {
                $user = Auth::guard('formateur')->user();
                $coursQuery = $user->mesformationsAchetees();
            }

            // Recherche insensible à la casse dans ses cours achetés
            $cours = $coursQuery
                // ->withAvg(['chapitres.avis as moyenne_notes' => function ($query) {
                //     $query->whereNotNull('note');
                // }], 'note')
                ->where(function ($q) use ($query) {
                    $q->whereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($query) . '%'])
                    ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%']);
                })
                ->select('formations.id', 'formations.titre', 'formations.duree')
                ->get();

            Log::info('Résultats recherche', [
                'query' => $query,
                'count' => $cours->count(),
                'user' => $user->id,
                'user_nom' => $user->nom,
            ]);

            return response()->json(
                $cours->map(function ($cours) {
                    return [
                        'id' => $cours->id,
                        'titre' => $cours->titre,
                        'duree' => $cours->duree,
                        // 'moyenne' => $cours->moyenne_notes 
                        //     ? number_format($cours->moyenne_notes, 1) 
                        //     : null,
                        'url' => route('formation.monCours', $cours->id)
                    ];
                })
            );

        } catch (\Exception $e) {
            Log::error('Erreur recherche', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchFormationEtd(Request $request)
    {
        $etudiant = auth('etudiant')->user();
        $query = $request->input('recherche');

        // Log de la requête entrée par l'utilisateur
        Log::info('Recherche formation lancée', [
            'etudiant_id' => $etudiant->id,
            'query' => $query
        ]);

        $formations = Formation::where('published', true)
            ->where(function ($q) use ($query) {
                $q->where('titre', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->orWhereHas('categorie', function ($subQ) use ($query) {
                    $subQ->where('nom_categorie', 'LIKE', '%' . $query . '%');
                });
            })
            // Exclure les formations déjà achetées par l'étudiant
            ->whereDoesntHave('etudiants', function ($q) use ($etudiant) {
                $q->where('etudiant_id', $etudiant->id)
                ->whereHas('paiements', function ($subQ) {
                    $subQ->where('status', 'validé');
                });
            })
            ->select('formations.id', 'formations.titre', 'formations.duree', 'formations.prix', 'formations.image')
            ->get();

        // Log du nombre de résultats trouvés
        Log::info('Résultats de la recherche', [
            'total' => $formations->count(),
            'formations_ids' => $formations->pluck('id')->toArray()
        ]);

        return response()->json(
            $formations->map(function ($formation) {
                return [
                    'id' => $formation->id,
                    'img' => $formation->image ? asset('storage/' . $formation->image) : asset('img/nn.png'),
                    'titre' => $formation->titre,
                    'duree' => $formation->duree,
                    'prix' => $formation->prix,
                    'url1' => route('formation.achat', ['formation_id' => $formation->id]),
                    'url2' => route('forma.detail', ['formation_id' => $formation->id]),
                ];
            })
        );
    }


    public function searchEf(Request $request)
    {
        $etudiant = auth('etudiant')->user();
        $query = $request->input('recherche');

        // Log de la requête entrée par l'utilisateur
        Log::info('Recherche formation lancée', [
            'etudiant_id' => $etudiant->id,
            'query' => $query
        ]);

        $formations = Formation::where('published', true)
            ->where(function ($q) use ($query) {
                $q->where('titre', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->orWhereHas('categorie', function ($subQ) use ($query) {
                    $subQ->where('nom_categorie', 'LIKE', '%' . $query . '%');
                });
            })
            // Exclure les formations déjà achetées par l'étudiant
            ->whereDoesntHave('etudiants', function ($q) use ($etudiant) {
                $q->where('etudiant_id', $etudiant->id)
                ->whereHas('paiements', function ($subQ) {
                    $subQ->where('status', 'validé');
                });
            })
            ->select('formations.id', 'formations.titre', 'formations.duree', 'formations.prix', 'formations.image')
            ->get();

        // Log du nombre de résultats trouvés
        Log::info('Résultats de la recherche', [
            'total' => $formations->count(),
            'formations_ids' => $formations->pluck('id')->toArray()
        ]);

        return response()->json(
            $formations->map(function ($formation) {
                return [
                    'id' => $formation->id,
                    'img' => $formation->image ? asset('storage/' . $formation->image) : asset('img/nn.png'),
                    'titre' => $formation->titre,
                    'duree' => $formation->duree,
                    'prix' => $formation->prix,
                    'url1' => route('formation.achat', ['formation_id' => $formation->id]),
                    'url2' => route('forma.detail', ['formation_id' => $formation->id]),
                ];
            })
        );
    }


    public function searchFormationFmt(Request $request)
    {
        $formateur = auth()->guard('formateur')->user();
        $query = $request->input('recherche');

        Log::info('Recherche formation lancée', [
            'formateur_id' => $formateur->id,
            'query' => $query,
            'nom' => $formateur->nom,
            'prenom' => $formateur->prenom,
        ]);

        $formationsAcheteesIds = $formateur->mesformationsAchetees()->pluck('formations.id');

        $formations = Formation::where('published', true)
        ->where('formateur_id', '!=', $formateur->id)
        ->whereNotIn('id', $formationsAcheteesIds)
        ->where(function ($q) use ($query) {
            $q->where('titre', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%");
        })
        ->get();

        return response()->json(
            $formations->map(function ($formation) {
                return [
                    'id' => $formation->id,
                    'img' => $formation->image ? asset('storage/' . $formation->image) : asset('img/nn.png'),
                    'titre' => $formation->titre,
                    'duree' => $formation->duree,
                    'prix' => $formation->prix,
                    'url1' => route('formation.achat', ['formation_id' => $formation->id]),
                    'url2' => route('forma.detail', ['formation_id' => $formation->id]),
                ];
            })
        );
    }


}
