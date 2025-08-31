<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Formateur;
use App\Models\Formation;
use App\Models\Etudiant;
use App\Models\Categorie;
use App\Models\Message;
use App\Models\SystemeCaise;
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
        $messagesCount = Message::count();
        $categoriesCount = Categorie::count();
        $systemeAccount = SystemeCaise::all();
        $totalCaisse = SystemeCaise::sum('montant');

        return view('admin.dashboard', compact(
            'invalidFormateursCount',
            'validFormateursCount',
            'formationsCount',
            'etudiantsCount',
            'categoriesCount',
            'messagesCount',
            'systemeAccount',
            'totalCaisse'
        ));
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

    public function gestEtudiant()
    {
        $etudiants = Etudiant::all();

        return view('admin.etudiant.index', compact('etudiants'));
    }

    public function gestEtudiantShow($id)
    {
        $etudiant = Etudiant::findOrFail($id);

        return view('admin.etudiant.show',compact('etudiant'));
    }

    public function activer($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->status = "active";
        $etudiant->save();

        return redirect()->back()->with('success', 'etudiant activé avec succès !');
    }

    public function desactiver($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->status = "desactive";
        $etudiant->save();

        return redirect()->back()->with('success', 'etudiant désactivé avec succès !');
    }

    public function actifshow(string $id)
    {
        $validFormateur = Formateur::where('id', $id)->where('is_validated', true)->first();
        return view('admin.formateur.actifShow', compact('validFormateur'));
    }

    public function activerformateur($id)
    {
        $formateur = Formateur::findOrFail($id);
        $formateur->status = "active";
        $formateur->save();

        return redirect()->back()->with('success', 'formateur activé avec succès !');
    }

    public function desactiverformateur($id)
    {
        $formateur = formateur::findOrFail($id);
        $formateur->status = "desactive";
        $formateur->save();

        return redirect()->back()->with('success', 'formateur désactivé avec succès !');
    }

    public function gestFormation()
    {
        $formations = Formation::all();

        return view('admin.formation.index', compact('formations'));
    }

    public function updatePourcentage(Request $request, string $id)
    {
        $request->validate([
            'pourcentage' => 'required|numeric|min:0|max:100',
        ]);

        $formateur = Formateur::findOrFail($id);
        $formateur->pourcentage = $request->input('pourcentage');
        $formateur->save();

        return redirect()->back()->with('success', 'Le pourcentage a été mis à jour avec succès.');
    }

    
}
