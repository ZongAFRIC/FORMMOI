<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Paiement;
use App\Models\Commande;
use App\Models\Etudiant;
use App\Models\Chapitre;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('etudiant.index');
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

    public function mesCours()
    {
        $etudiant = auth('etudiant')->user();

        // Formations achetées
        $mesFormations = $etudiant->formationsAchetees()->get();
        return view('etudiant.listecours', compact('mesFormations'));
    }

    public function Achat($formation_id){

        $formation = Formation::findOrFail($formation_id);
        return view('etudiant.achatformation', compact('formation'));
    }

    public function effectuerPaiement(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric',
            'methode' => 'required|string',
            'etudiant_id' => 'required|exists:etudiants,id',
            'formation_id' => 'nullable|exists:formations,id',
            'commande_id' => 'nullable|exists:commandes,id',
        ]);

        // Vérifier qu une clé (formation_id ou commande_id) est présente
        if (!$request->formation_id && !$request->commande_id) {
            return back()->withErrors(['error' => 'Vous devez spécifier une formation ou une commande pour le paiement.']);
        }

        // Initialisation de l'étudiant
        $etudiant = Etudiant::findOrFail($request->etudiant_id);

        // Enregistrer le paiement
        $paiement = Paiement::create([
            'montant' => $request->montant,
            'date' => now(),
            'methode' => $request->methode,
            'status' => 'validé',
            'etudiant_id' => $etudiant->id,
            'formation_id' => $request->formation_id,
            'commande_id' => $request->commande_id,
        ]);

        // Si une formation est spécifiée, l'associer à l'étudiant
        if ($request->formation_id) {
            $etudiant->formationsAchetees()->syncWithoutDetaching([$request->formation_id]);

            return redirect()->route('etudiant.cours', ['formation_id' => $request->formation_id])
                ->with('success', 'Paiement de la formation effectué avec succès.');
        }

        // Si une commande est spécifiée, rediriger vers les détails de la commande
        if ($request->commande_id) {
            return redirect()->route('commande.detail', ['commande_id' => $request->commande_id])
                ->with('success', 'Paiement de la commande effectué avec succès.');
        }

        // Par défaut, rediriger vers le tableau de bord de l'étudiant
        return redirect()->route('etudiant.dashboard')->with('success', 'Paiement enregistré avec succès.');
    }

    public function monCours($id, Request $request)
    {
        // Récupérer la formation et ses chapitres
        $formation = Formation::with('chapitres')->findOrFail($id);

        // Vérifier si un chapitre spécifique est demandé
        $chapitreActif = null;
        if ($request->has('chapitre_id')) {
            $chapitreActif = Chapitre::where('id', $request->chapitre_id)
                ->where('formation_id', $formation->id) // Assurez-vous que le chapitre appartient à la formation
                ->first();
        }

        // Par défaut, prendre le premier chapitre si aucun chapitre actif n'est défini
        if (!$chapitreActif) {
            $chapitreActif = $formation->chapitres->first();
        }

        return view('etudiant.moncours', [
            'formation' => $formation,
            'chapitres' => $formation->chapitres,
            'chapitreActif' => $chapitreActif, // Chapitre actif à transmettre à la vue
        ]);
    }

    public function mesCoursListe()
    {
        //
    }

}
