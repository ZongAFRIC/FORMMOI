<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Formateur;
use App\Models\Categorie;
use App\Models\Etudiant;
use App\Models\Chapitre;

class FormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->guard('formateur')->check()) {
            // L'utilisateur est bien authentifié en tant que formateur
            $formateur = auth()->guard('formateur')->user();
            $mesformationCount = $formateur->formations()->count();
        } else {
            // Redirection vers la page de connexion si l'utilisateur n'est pas authentifié
            return redirect()->route('login')->with('error', 'Veuillez vous connecter en tant que formateur.');
        }

        $formationsCount = Formation::count();

        if (!$formateur) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour voir vos formations.');
        }

        return view('formateur.dashboard', compact('formationsCount','mesformationCount','formationsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function mesFormations()
    {
        $formateur = auth()->guard('formateur')->user();
        $mesformations = $formateur->formations;
        // $formation = Formation::with('chapitres')->findOrFail($id);
        // $nombreChapitres = $formation->chapitres->count();
        return view('formateur.mesformations', compact('mesformations'));
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

}
