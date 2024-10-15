<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\Formateur;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterFormateurController extends Controller
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
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'min:8'],
            'image'=>['image','max:5000'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Formateur::class],
            'password' => ['required','min:8', Rules\Password::defaults()],
        ]);
        /** @var UploadedFile|null $image */
        if($request->password == $request->password_confirmation){
            $image = $request->image;
            if($image != null && !$image->getError()){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $imagePath = $file->storeAs('users/image', $filename,'public');
                $user=User::create([
                    'nom' =>strtoupper($request->nom) ,
                    'prenom' =>strtoupper($request->prenom) ,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'image'=> $imagePath,
                    'password' => Hash::make($request->password),
                ]);
            }
            else{
                $user=User::create([
                    'nom' =>strtoupper($request->nom) ,
                    'prenom' =>strtoupper($request->prenom),
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'password' => Hash::make($request->password),
                ]);
            }
            return redirect()->route('login1')->with('success','compte crée avec success');
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
