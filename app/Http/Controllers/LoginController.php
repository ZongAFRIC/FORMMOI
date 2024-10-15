<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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


    // public function login(Request $request)
    // {
    //     // Validation des champs de connexion
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Tentative de connexion en tant qu'étudiant
    //     if ($etudiant = Etudiant::where('email', $credentials['email'])->first()) {
    //         if (Hash::check($credentials['password'], $etudiant->password)) {
    //             Auth::guard('web')->login($etudiant);
    //             return redirect()->route('dashboard.etudiant')->with('success', 'Bienvenue étudiant');
    //         }
    //     }

    //     // Tentative de connexion en tant que formateur
    //     if ($formateur = Formateur::where('email', $credentials['email'])->first()) {
    //         if (Hash::check($credentials['password'], $formateur->password)) {
    //             Auth::guard('web')->login($formateur);
    //             return redirect()->route('dashboard.formateur')->with('success', 'Bienvenue formateur');
    //         }
    //     }

    //     // Si aucun utilisateur trouvé, retour avec erreur
    //     return back()->withErrors([
    //         'email' => 'Ces informations d\'identification ne correspondent pas à nos enregistrements.',
    //     ]);
    // }

    // public function login(Request $request)
    // {
        
    //     // Valider les données du formulaire
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //         'user_type' => 'required|string|in:etudiant,formateur'
    //     ]);

    //     // Récupérer les informations du formulaire
    //     $credentials = $request->only('email', 'password');
    //     dd($credentials);
    //     $userType = $request->user_type;

    //     // Déterminer quel guard utiliser
    //     if ($userType === 'etudiant') {
    //         if (Auth::guard('etudiant')->attempt($credentials)) {
    //             $request->session()->regenerate();
    //             return redirect()->intended('/dashbord1');
    //         }
    //     } elseif ($userType === 'formateur') {
    //         if (Auth::guard('formateur')->attempt($credentials)) {
    //             $request->session()->regenerate();
    //             return redirect()->intended('/dashboard');
    //         }
    //     }

    //     // Si l'authentification échoue
    //     return back()->withErrors([
    //         'email' => 'Les identifiants sont incorrects ou ne correspondent pas à un utilisateur valide.',
    //     ])->withInput($request->except('password'));
    // }

    public function loginEtudiant(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('etudiant')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/etudiant/dashbord');
        }
 
        return back()->withErrors([ 'error','Identifiants incorrects.',]);

    }


    public function loginFormateur(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('formateur')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/formateur/dashbord');
        }
 
        return back()->withErrors([ 'error','Les identifiants entrés sont incorrects.',]);

    }

    public function logout(Request $request)
    {
        $userType = $request->user_type;

        if ($userType === 'etudiant') {
            Auth::guard('etudiant')->logout();
        } elseif ($userType === 'formateur') {
            Auth::guard('formateur')->logout();
        }

        return redirect('/login');
    }

   
}



