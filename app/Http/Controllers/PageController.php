<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Chapitre;
use App\Models\Formation;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Formateur;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::where('published',true)->get();
        $categories = Categorie::all();
        $formationsCount = Categorie::withCount('formations')->get();
        $formateurs = Formation::all();
        return view('page.index', compact('formations', 'categories', 'formationsCount', 'formateurs'));
    }

    public function login()
    {
        return view('page.login');
    }

    public function dashboard()
    {
        return ('dashboard dashboard dashboard');
    }

    public function dashb()
    {
        return ('dashboard dashboard dashboard');
    }

    public function dashboard1()
    {
        return ('dashboard formateur dashboard formateur formateur formateur formateur formateur formateur\nformateurformateurformateurformateurdashboard');
    }

    public function register()
    {
        return view('page.register');
    }

    // public function login()
    // {
    //     return view('page.login');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateMotDePasse(Request $request, string $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth('etudiant')->user()->password)) {
            return back()->withErrors(['old_password' => 'L\'ancien mot de passe est incorrect.']);
        }

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->password = bcrypt($request->password);
        $etudiant->save();

        return redirect()->route('profil')->with('success', 'Mot de passe mis à jour avec succès.');
    }

    public function editCompteEmail(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:etudiants,email',
        ]);

        if (auth()->guard('etudiant')->user()) {
            $etudiant = Etudiant::findOrFail($id);
            $etudiant->email = $request->email;
            $etudiant->save();
        } elseif (auth()->guard('formateur')->user()) {
            $formateur = Formateur::findOrFail($id);
            $formateur->email = $request->email;
            $formateur->save();
        }

        return redirect()->route('profil')->with('success', 'Adresse email mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCompte(string $id)
{
    if (auth()->guard('etudiant')->check()) {
        $user = auth()->guard('etudiant')->user();
    } elseif (auth()->guard('formateur')->check()) {
        $user = auth()->guard('formateur')->user();
    } else {
        return redirect()->route('login')->with('error', 'Utilisateur non authentifié.');
    }

    if (!$user) {
        return redirect()->route('login')->with('error', 'Utilisateur introuvable.');
    }

    if ($user instanceof Etudiant || $user instanceof Formateur) {
        $user->delete();
    } else {
        return redirect()->route('login')->with('error', 'Utilisateur non valide');
    }

    auth()->logout(); // Déconnexion sécurisée

    return redirect()->route('/')->with('success', 'Votre compte a été supprimé.');
}

    public function paramettre()
    {
        if (auth()->guard('etudiant')->check()) {
            $user = auth()->guard('etudiant')->user();
            $layout = 'layout.appEtudiant';
        } elseif (auth()->guard('formateur')->check()) {
            $user = auth()->guard('formateur')->user();
            $layout = 'layout.appFormateur';
        } else {
            return redirect()->route('login')->with('error', 'Utilisateur non authentifié');
        }
    
        return view('pagesCommunes.paramettre', compact('layout', 'user'));
    }

    public function gererCompte()
    {
        if (auth()->guard('etudiant')->check()) {
            $user = auth()->guard('etudiant')->user();
            $layout = 'layout.appEtudiant';
        } elseif (auth()->guard('formateur')->check()) {
            $user = auth()->guard('formateur')->user();
            $layout = 'layout.appFormateur';
        } else {
            return redirect()->route('login')->with('error', 'Utilisateur non authentifié');
        }

        // dd($user->nom);
        return view('pagesCommunes.gerercompte', compact('layout', 'user'));
    }

    public function recherche(Request $request)
    {
        $query = $request->input('recherche');

        // Si l'utilisateur saisit quelque chose
        if ($query) {
            $formations = Formation::where('titre', 'like', "%{$query}%")
                ->orWhere('duree', 'like', "%{$query}%")
                ->get();
        } else {
            $formations = Formation::all();
        }

        // On renvoie une vue partielle avec les résultats
        return view('page.formations-liste', compact('formations'))->render();
    }

}
