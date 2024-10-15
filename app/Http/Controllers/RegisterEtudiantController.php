<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterEtudiantController extends Controller
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

        // $request->validate([
        //     'nom' => ['required', 'string', 'max:255'],
        //     'prenom' => ['required', 'string', 'max:255'],
        //     'telephone' => ['required', 'min:8'],
        //     'image'=>'file|mimes:jpeg,png,pdf|max:2048',
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Etudiant::class],
        //     'password' => ['required','min:8', Rules\Password::defaults()],
        // ]);

        // // Enregistrement du fichier de capture de panne
        // if ($request->hasFile('capture_panne')) {
        //     $file = $request->file('capture_panne');
        //     $path = $file->store('captures_pannes');
        // }

        // // Enregistrement en base de données
        // $incident = new Incident($request->except('capture_panne'));
        // $incident->capture_panne_path = $path ?? null;
        // $incident->save();// Enregistrement du fichier de capture de panne
        // if ($request->hasFile('capture_panne')) {
        //     $file = $request->file('capture_panne');
        //     $path = $file->store('captures_pannes');
        // }

        // // Enregistrement en base de données
        // $incident = new Incident($request->except('capture_panne'));
        // $incident->capture_panne_path = $path ?? null;
        // $incident->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'min:8'],
            'image'=>'file|mimes:jpeg,png,pdf|max:2048',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Etudiant::class],
            'password' => ['required','min:8', Rules\Password::defaults()],
        ]);
        /** @var UploadedFile|null $image */
        if($request->password == $request->password_confirmation){
            $image = $request->image;
            if($image != null && !$image->getError()){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $imagePath = $file->storeAs('etudiants/image', $filename,'public');
                $user=Etudiant::create([
                    'nom' =>strtoupper($request->nom) ,
                    'prenom' =>strtoupper($request->prenom) ,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'image'=> $imagePath,
                    'password' => Hash::make($request->password),
                ]);
            }
            else{
                $user=Etudiant::create([
                    'nom' =>strtoupper($request->nom) ,
                    'prenom' =>strtoupper($request->prenom),
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'password' => Hash::make($request->password),
                ]);
            }
            return redirect()->route('dashboard1')->with('success','compte crée avec success');
        }else{
            return back()->withErrors([
                'password_confirmation'=> 'Mot de passe confirmé ne correspond pas'
            ]);
        }
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
}
