<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Validator;
use App\Models\Etudiant;
use App\Models\Formateur;

class RegisterController extends Controller
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

    public function registerEtudiant(Request $request)
{
    // Validation des champs pour l'étudiant
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Etudiant::class],
        'telephone' => 'required|string|min:8',
        'image' => 'image|max:2048',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if($request->password == $request->password_confirmation){
        $image = $request->image;
        if($image != null && !$image->getError()){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $imagePath = $file->storeAs('etudiant/image', $filename,'public');
            $etudiant=Etudiant::create([
                'nom' =>strtoupper($request->nom) ,
                'prenom' =>strtoupper($request->prenom) ,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'image'=> $imagePath,
                'password' => Hash::make($request->password),
            ]);
        }
        else{
            $etudiant=Etudiant::create([
                'nom' =>strtoupper($request->nom) ,
                'prenom' =>strtoupper($request->prenom) ,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'password' => Hash::make($request->password),
            ]);
        }
        
        auth()->login($etudiant);
        return redirect()->route('etudiant.dashboard')->with('success','compte crée avec success');
    }else{
        return back()->withErrors([
            'password_confirmation'=> 'Les Mot de passe ne correspondent pas'
        ]);
    }
}

public function registerFormateur(Request $request)
{
    // Validation des champs pour le formateur
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Formateur::class],
        'password' => 'required|string|min:8',
        'image' => 'nullable|image|max:2048',
        'cv' => 'required|file|max:2048',
        'attestation' => 'required|file|max:2048',
        'bio' => 'nullable|string',
    ]);

    $cvPath = null;
    if ($request->hasFile('cv') && !$request->file('cv')->getError()) {
        $cvFile = $request->file('cv');
        $cvFilename = $cvFile->getClientOriginalName();
        $cvPath = $cvFile->storeAs('formateurs/cv', $cvFilename, 'public');
    }

    $attestationPath = null;
    if ($request->hasFile('attestation') && !$request->file('attestation')->getError()) {
        $attestationFile = $request->file('attestation');
        $attestationFilename = $attestationFile->getClientOriginalName();
        $attestationPath = $attestationFile->storeAs('formateurs/attestation', $attestationFilename, 'public');
    }

    if($request->password == $request->password_confirmation){
        $image = $request->image;
        if($image != null && !$image->getError()){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $imagePath = $file->storeAs('formateurs/image', $filename,'public');
            $formateur=Formateur::create([
                'nom' =>strtoupper($request->nom) ,
                'prenom' =>strtoupper($request->prenom) ,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'image'=> $imagePath,
                'is_validated' => false,
                'status' => 'active',
                'bio' => $request->bio,
                'attestation' => $attestationPath,
                'cv' => $cvPath,
                'password' => Hash::make($request->password),
            ]);
        }
        else{
            $formateur=Formateur::create([
                'nom' =>strtoupper($request->nom) ,
                'prenom' =>strtoupper($request->prenom) ,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'password' => Hash::make($request->password),
                'is_validated' => false,
                'status' => 'active',
                'bio' => $request->bio,
                'attestation' => $attestationPath,
                'cv' => $cvPath,
            ]);
        }
        auth()->login($formateur);
        return redirect()->route('formateur.dashboard')->with('success','compte crée avec success');
    }else{
        return back()->withErrors([
            'password_confirmation'=> 'Les Mot de passe ne correspondent pas'
        ]);

}

}
}