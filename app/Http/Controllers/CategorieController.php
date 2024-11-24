<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorie;
use App\Models\Formation;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::orderBy('created_at','DESC')->get();
       return view('admin.categorie.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorie.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
    //     // Categorie::create($request->all());
    //     $request->validate([
    //         'nom_categorie' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
    //     ]);
    
    //     $categorie = new Categorie();
    //     $categorie->nom_categorie = $request->nom_categorie;
    
    //     if ($request->hasFile('image')) {
    //         // Stocke l'image dans storage/app/public/categories
    //         $path = $request->file('image')->store('categories', 'public');
    //         $categorie->image = $path;
    //     }
    
    //     $categorie->save();
    //     return redirect()->route('gestion.categorie')->with('success', 'Categorie ajouté avec succès.');
    
    

    $request->validate([
        'nom_categorie' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
    ]);
    
    
    $image = $request->image;
    if($image != null && !$image->getError()){

        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $imagePath = $file->storeAs('categories/image', $filename,'public');
        $categorie=Categorie::create([
            'nom_categorie' => $request->nom_categorie,
            'image'=> $imagePath,
        ]);
    }
    else{
        $categorie=Categorie::create([
            'nom_categorie' => $request->nom_categorie,
        ]);
    }
    
    return redirect()->route('gestion.categorie')->with('success', 'Categorie ajouté avec succès.');
    
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categorie.show', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categorie.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
    
        $categorie = Categorie::findOrFail($id);
        $categorie->nom_categorie = $request->nom_categorie;
    
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si nécessaire
            if ($categorie->image) {
                Storage::disk('public')->delete($categorie->image);
            }
            
            // Stocker la nouvelle image
            $path = $request->file('image')->store('categories', 'public');
            $categorie->image = $path;
        }
    
        $categorie->save();
    
        return redirect()->route('gestion.categorie')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->route('gestion.categorie')->with('success', 'Categorie supprimé avec succès.');
    }

    public function retour()
    {
        return redirect()->route('gestion.categorie');
    }

    public function listCategorie()
    {
        $categorie = Categorie::withCount('formations')->get();

        return view('categorie.list',compact('categorie'));
    }

    public function formationsParCategorie($nom_categorie)
    {
        $categorie = Categorie::where('nom_categorie', $nom_categorie)->with('formations')->firstOrFail();
        $formationsCount = Categorie::withCount('formations')->get();
        return view('formation.parCategorie', compact('categorie','formationsCount'));
    }


}
