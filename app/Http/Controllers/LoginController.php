<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginEtudiant(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Déconnecter tout utilisateur précédemment connecté
        if (Auth::guard('formateur')->check()) {
            Auth::guard('formateur')->logout();
        }

        if (Auth::guard('etudiant')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/etudiant/acceuil');
        }
 
        return back()->withErrors([ 'error','Identifiants incorrects.',]);

    }


    // public function loginFormateur(Request $request){

    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::guard('formateur')->attempt($credentials)) {
    //         // $request->session()->regenerate();
 
    //         if (Auth::guard('formateur')->attempt($credentials)) {
                
    //             if (Auth::guard('formateur')->user()->is_validated) {
    //                 $request->session()->regenerate();
    //                 return redirect()->intended('/formateur/dashbord');
    //             } else { 
    //                 Auth::guard('formateur')->logout();
    //                 return redirect()->back()->with('error', 'Votre compte doit être validé par un administrateur avant de pouvoir vous connecter.');
    //             }
    //         }
    //         // return redirect()->intended('/formateur/dashbord');
    //     }
 
    //     return redirect('/login#formateur')->withErrors([ 'error','Les identifiants entrés sont incorrects.',]);

    // }

    public function loginFormateur(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Déconnecter tout utilisateur précédemment connecté
        if (Auth::guard('etudiant')->check()) {
            Auth::guard('etudiant')->logout();
        }

        if (Auth::guard('formateur')->attempt($credentials)) {
            if (Auth::guard('formateur')->user()->is_validated) {
                $request->session()->regenerate();
                return redirect()->intended('/formateur/dashbord');
            } else {
                Auth::guard('formateur')->logout();
                return redirect()->back()->with('error', 'Votre compte doit être validé par un administrateur avant de pouvoir vous connecter.');
            }
        }

        return redirect('/login#formateur')->withErrors(['error' => 'Les identifiants entrés sont incorrects.']);
    }


    public function logoutFormateur(Request $request)
    {
        auth()->guard('formateur')->logout();  // Déconnexion du formateur
        $request->session()->invalidate();     // Invalidation de la session
        $request->session()->regenerateToken(); // Regénération du token CSRF

        return redirect('/login#formateur');   // Redirection vers la page de connexion
    }

    public function logoutEtudiant(Request $request)
    {
        auth()->guard('etudiant')->logout();  // Déconnexion de l'etudiant
        $request->session()->invalidate();     // Invalidation de la session
        $request->session()->regenerateToken(); // Regénération du token CSRF

        return redirect('/login#etudiant');   // Redirection vers la page de connexion
    }

   
}



