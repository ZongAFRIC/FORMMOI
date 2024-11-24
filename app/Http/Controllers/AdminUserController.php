<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Formateur;
use App\Models\Formation;
use App\Models\Etudiant;
use App\Models\Categorie;
use App\Notifications\FormateurValidated;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login()
    {
        return view('admin.login');
    }


    public function index()
    {
        $invalidFormateurs = Formateur::where('is_validated', false)->get();
        $invalidFormateursCount = $invalidFormateurs->count();
        $validFormateurs = Formateur::where('is_validated', true)->get();
        $validFormateursCount = $validFormateurs->count();
        $formationsCount = Formation::count();
        $etudiantsCount = Etudiant::count();
        $categoriesCount = Categorie::count();

        return view('admin.dashboard', compact('invalidFormateursCount','validFormateursCount','formationsCount','etudiantsCount','categoriesCount'));
    }

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
    public function logged(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/admin/dashboard');
        }
 
        return back()->withErrors([
            'email' => 'Identifiant ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invalidFormateur = Formateur::where('id', $id)->where('is_validated', false)->first();
        return view('admin.formateur.enattenteShow', compact('invalidFormateur'));
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

    
    public function gestFormateur()
    {
        $validFormateurs = Formateur::where('is_validated', true)->get();
        return view('admin.formateur.index', compact('validFormateurs'));
    }

    public function gestFormateurAttente()
    {
        $invalidFormateurs = Formateur::where('is_validated', false)->get();
        return view('admin.formateur.enattente', compact('invalidFormateurs'));
    }

    public function validerFormateur($id, Request $request)
    {
        // Récupère le formateur
        $formateur = Formateur::findOrFail($id);
        
        // Met à jour le champ 'is_validated' en fonction de l'état de la checkbox
        $formateur->is_validated = $request->has('is_validated');
        $formateur->save();

        //envois de la notification

        if ($formateur->is_validated) {
            $formateur->notify(new FormateurValidated());
        }

        return redirect()->route('admin.gestFormateurAttente')->with('success', 'Le formateur est validé.');
    }
}
