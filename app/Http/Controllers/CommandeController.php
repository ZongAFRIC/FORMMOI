<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Formation;
use App\Models\Etudiant;
use App\Models\Formateur;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth('etudiant')->check()) {
            $utilisateur = auth('etudiant')->user();
            $commandes = $utilisateur->commandes()->with('formations')->get();
        } elseif (auth('formateur')->check()) {
            $utilisateur = auth('formateur')->user();
            $commandes = Commande::where('etudiant_id', $utilisateur->id)
                ->where('type_utilisateur', 'formateur')
                ->with('formations')
                ->get();
        } else {
            return abort(403, 'Accès interdit.');
        }
    
        return view('commande.index', compact('commandes'));
    
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
        $request->validate([
            'formations' => 'required|array',
            'formations.*' => 'exists:formations,id',
        ]);
    
        // Déterminer si l'utilisateur connecté est un étudiant ou un formateur
        $utilisateur = auth('etudiant')->check() ? auth('etudiant')->user() : auth('formateur')->user();
        $typeUtilisateur = auth('etudiant')->check() ? 'etudiant' : 'formateur';
    
        // Calculer le montant total
        $formations = Formation::whereIn('id', $request->formations)->get();
        $montantTotal = $formations->sum('prix');
    
        // Créer la commande
        $commande = Commande::create([
            'etudiant_id' => $utilisateur->id,
            'montant_total' => $montantTotal,
            'status' => 'en_attente',
            'type_utilisateur' => $typeUtilisateur,
        ]);
    
        // Associer les formations à la commande
        $commande->formations()->attach($request->formations);
    
        return redirect()->route('dashboard')->with('success', 'Commande créée avec succès.');
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

    public function getFormationsPanier($userId, $role)
    {
        if ($role === 'etudiant') {
            // Logique pour récupérer les formations dans le panier de l'étudiant
            return Commande::where('etudiant_id', $userId)->get();
        } elseif ($role === 'formateur') {
            //  les formations dans le panier du formateur
            return Commande::where('formateur_id', $userId)->get();
        }
        return [];
    }


    public function ajouterAuPanier(Request $request)
    {
        // Valider l'ID de la formation
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
        ]);

        // Récupérer l'ID de la formation
        $formationId = $request->formation_id;

        // Vérifier si le panier existe déjà dans la session
        $panier = session()->get('panier', []);

        // Ajouter la formation au panier (éviter les doublons)
        if (!in_array($formationId, $panier)) {
            $panier[] = $formationId;
            session()->put('panier', $panier); // Stocker le panier mis à jour
        }

        return redirect()->back()->with('success', 'Formation ajoutée au panier !');
    }

    public function afficherPanier()
    {
        // Récupérer les formations du panier depuis la session
        $panier = session()->get('panier', []);

        // Charger les détails des formations
        $formations = Formation::whereIn('id', $panier)->get();
        $total = 0;
        foreach ($formations as $formation) {
            $total += $formation->prix; // Ajouter le prix de chaque formation
        }

        return view('panier.panier', compact('formations','total'));
    }


    public function retirerDuPanier(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
        ]);

        // Récupérer le panier depuis la session
        $panier = session()->get('panier', []);

        // Retirer la formation
        if (($key = array_search($request->formation_id, $panier)) !== false) {
            unset($panier[$key]);
            session()->put('panier', $panier); // Mettre à jour le panier
        }

        return redirect()->back()->with('success', 'Formation retirée du panier !');
    }

    public function validerPanier(Request $request)
    {
        // Vérification de l'utilisateur connecté (étudiant ou formateur)
        if (auth('etudiant')->check()) {
            $userId = auth()->guard('etudiant')->user()->id;
            $role = 'etudiant';
        } elseif (auth('formateur')->check()) {
            $userId = auth()->guard('formateur')->user()->id;
            $role = 'formateur';
        } else {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour valider votre panier.');
        }

        // récupération des formations du panier de l'utilisateur connecté
        $formations = $this->getFormationsPanier($userId, $role);

        // Calcul du total de la commande
        $total = 0;
        foreach ($formations as $formation) {
            $total += $formation->prix;
        }

        // Créer la commande
        $commande = Commande::create([
            'utilisateur_id' => $userId, // Lier l'utilisateur connecté à la commande
            'total' => $total,
            'status' => 'en attente', // Statut de la commande
            'type_utilisateur' => $role, // Définir le type d'utilisateur
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ajouter les formations à la commande
        foreach ($formations as $formation) {
            $commande->formations()->attach($formation->id, ['quantite' => 1]); // Si vous avez une quantité de formation
        }

        return redirect()->route('commande.detail', ['commande_id' => $commande->id])
                        ->with('success', 'Votre commande a été validée avec succès.');
    }

    public function detail($commande_id)
    {
        $commande = Commande::with(['formations'])->findOrFail($commande_id);
        return view('commande.detail',compact('commande'));
    }

}
