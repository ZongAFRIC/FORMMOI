<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Formateur;
use App\Models\Categorie;
use App\Models\Etudiant;
use App\Models\Chapitre;
use App\Models\Paiement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->guard('formateur')->check()) {
            $formateur = auth()->guard('formateur')->user();
            $mesformationCount = $formateur->formations()->count();
        } else {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter en tant que formateur.');
        }

        $formationsCount = Formation::count();
        $mesformations = $formateur->formations;

        // Formations déjà achetées par ce formateur (avec les objets Formation)
        $formationsAchetees = $formateur->mesformationsAchetees()->get();

        // Liste des IDs des formations achetées pour l'exclusion
        $formationsAcheteesIds = $formationsAchetees->pluck('id'); // Plutôt que pluck('formations.id')

        // Toutes les formations publiées (sauf celles du formateur connecté et celles achetées)
        $formationsDispo = Formation::where('published', true)
            ->where('formateur_id', '!=', $formateur->id)
            ->whereNotIn('id', $formationsAcheteesIds)
            ->get();

        if (!$formateur) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour voir vos formations.');
        }
        $mesCours = $formateur->mesformationsAchetees()->get();
        $mesCoursCount = $mesCours->count();
        return view('formateur.dashboard', compact(
            'mesformationCount',
            'formationsCount',
            'formateur',
            'formationsDispo',
            'mesCoursCount'
        ));
    }

    public function mesFormations()
    {
        $formateur = auth()->guard('formateur')->user();
        $mesformations = $formateur->formations;
        // $formation = Formation::with('chapitres')->findOrFail($id);
        // $nombreChapitres = $formation->chapitres->count();
        return view('formateur.mesformations', compact('mesformations'));
    }

    public function attente()
    {
        return view('formateur.espace');
    }

    public function profil()
    {
        return view('formateur.profil');
    }

    public function profiledit()
    {
        $formateur = Auth::guard('formateur')->user();
        return view('formateur.profiledit',compact('formateur'));
    }

    public function profilupdate(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'telephone' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255',
            'bio' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $formateur = Auth::guard('formateur')->user();
        $formateur = Formateur::findOrFail($id);

        if ($request->has('nom')) {
            $formateur->nom = $request->nom;
        }
        if ($request->has('prenom')) {
            $formateur->prenom = $request->prenom;
        }
        if ($request->has('telephone')) {
            $formateur->telephone = $request->telephone;
        }
        if ($request->has('email')) {
            $formateur->email = $request->email;
        }
        if ($request->has('bio')) {
            $formateur->bio = $request->bio;
        }
        if ($request->filled('password')) {
            $formateur->password = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si nécessaire
            if ($formateur->image) {
                Storage::disk('public')->delete($formateur->image);
            }
            
            // Stocker la nouvelle image
            $path = $request->file('image')->store('formateurs/image', 'public');
            $formateur->image = $path;
        }

        $formateur->save();

        return redirect()->route('monprofil')->with('success', 'Profil mis à jour avec succès.');

    }

    public function Achat($formation_id){

        $formation = Formation::findOrFail($formation_id);
        return view('formateur.achat', compact('formation'));
    }


    public function mesCours()
    {
        // dd(session()->all());
        $formateur = auth('formateur')->user();
        $nom = $formateur->nom;
        
        // dd($nom);
        // Formations achetées
        $mesFormations = $formateur->mesformationsAchetees()->get();
        $mesformationCount = $mesFormations->count();
        // dd($mesformationCount);
        return view('formateur.listecours', compact('mesFormations'));
    }


    public function caisse()
    {
        $formateur = auth('formateur')->user();

        // Log::info('Formateur: ' . $formateur->nom . ' ' . $formateur->prenom);
        // dd($formateur->id);
        // Récupérer les paiements des formations de ce formateur
        if (!$formateur) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }
    
        $paiements = Paiement::whereHas('formation', function ($query) use ($formateur) {
            $query->where('formateur_id', $formateur->id);
            })->with('formation', 'etudiant')->orderBy('date', 'desc')->get();
        // Log::info('Paiements: ' . $paiements . ' effectués' . $paiements->count());
        // dd($paiements);
        return view('formateur.historique', compact('formateur','paiements'));
    }

    public function searchFormation(Request $request)
    {
        $query = $request->input('recherche'); // Récupérer la requête de recherche

        // Rechercher les catégories par nom
        $formations = Formation::where('titre', 'LIKE', '%' . Str::lower($query) . '%')
            ->orWhere('titre', 'LIKE', '%' . Str::ucfirst($query) . '%')
            ->get()
            ->map(function ($formation) {
                $formation->url = route('formateur.formations', ['titre' => $formation->titre]);
                return $formation;
        });

        return response()->json($formations);
    }

}
