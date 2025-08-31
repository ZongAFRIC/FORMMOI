<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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

    // public function formationsParCategorie($nom_categorie)
    // {
    //     $categorie = Categorie::where('nom_categorie', $nom_categorie)->with('formations')->firstOrFail();
    //     $formationsCount = Categorie::withCount('formations')->get();
    //     return view('formation.parCategorie', compact('categorie','formationsCount'));
    // }

    public function search(Request $request)
    {
        $query = $request->input('recherche'); // Récupérer la requête de recherche

        // Rechercher les catégories par nom
        $categories = Categorie::where('nom_categorie', 'LIKE', '%' . Str::lower($query) . '%')
            ->orWhere('nom_categorie', 'LIKE', '%' . Str::ucfirst($query) . '%')
            ->withCount('formations')
            ->get(); // Récupérer tous les résultats sans pagination

        // Ajouter l'URL à chaque catégorie
        $categories->transform(function ($categorie) {
            $categorie->url = route('categorie.formations', ['nom_categorie' => $categorie->nom_categorie]);
            return $categorie;
        });

        return response()->json($categories);
    }

    public function categoriesListe()
    {
        $categories = Categorie::withCount('formations')->get();

        // Déterminer le  layout selon le type d'utilisateur
        if (auth()->guard('etudiant')->user()) {
            $layout = 'layout.appEtudiant';
        } elseif (auth()->guard('formateur')->user()) {
            $layout = 'layout.appFormateur';
        }

        return view('categorie.list', compact('categories', 'layout'));
    }

    public function formationsParCategorie($nom_categorie)
    {
        $categorie = Categorie::where('nom_categorie', $nom_categorie)->with('formations')->firstOrFail();
        $formationsCount = Categorie::withCount('formations')->get();

        if (auth()->guard('etudiant')->user()) {
            $layout = 'layout.appEtudiant';
        } elseif (auth()->guard('formateur')->user()) {
            $layout = 'layout.appFormateur';
        }
        return view('formation.parCategorie', compact('categorie','formationsCount', 'layout'));
    }

}
