<?php

namespace App\Http\Controllers;

use App\Models\AppCaisse;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Paiement;
use App\Models\SystemeCaise;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
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
        $request->validate([
            'id' => 'required|numeric',
            'montant' => 'required|numeric|min:0',
            'method' => 'required|string',
        ]);
    
        // Récupérer la formation
        $formation = Formation::find($request->id);
        if (!$formation) {
            return back()->withErrors(['id' => 'Formation introuvable.']);
        }
    
        // Vérification du montant
        if ($request->montant < $formation->prix) {
            return back()->withErrors(['montant' => 'Le montant saisi est insuffisant.']);
        }
    
        // Création du paiement
        Paiement::create([
            'montant' => $request->montant,
            'date' => now(),
            'methode' => $request->method,
            'status' => 'validé',
            'formation_id' => $formation->id,
            'etudiant_id' => auth()->guard('etudiant')->id() ?? null,
            'formateur_id' => auth()->guard('formateur')->id() ?? null,
        ]);
    
        // Redirection avec message de succès
        return redirect()->route('formation.details', ['id' => $formation->id])
                         ->with('success', 'Paiement effectué avec succès !');
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

    public function orangeMoney($formation_id)
    {
        $formation = Formation::findOrFail($formation_id);
        return view('pagesCommunes.orange-money', compact('formation_id','formation'));
    }

    public function moovMoney($formation_id)
    {
        $formation = Formation::findOrFail($formation_id);
        return view('pagesCommunes.moov-maney', compact('formation_id','formation'));
    }

    public function telecelMoney($formation_id)
    {
        $formation = Formation::findOrFail($formation_id);
        return view('pagesCommunes.telecel-money', compact('formation_id','formation'));
    }

    public function sankMoney($formation_id)
    {
        $formation = Formation::findOrFail($formation_id);
        return view('pagesCommunes.sank-money', compact('formation_id','formation'));
    }

    public function corisMoney($formation_id)
    {
        $formation = Formation::findOrFail($formation_id);
        return view('pagesCommunes.coris-money', compact('formation_id','formation'));
    }

    public function wave($formation_id)
    {
        $formation = Formation::findOrFail($formation_id);
        return view('pagesCommunes.wave', compact('formation_id','formation'));
    }


    //proccessus de paiement de formation
    
    public function processusPaiement(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'formation_id' => 'required|integer',
            'method' => 'required|string',
            'montant' => 'required|numeric',
        ]);

        // Récupérer les données du formulaire
        $formationId = $request->input('formation_id');
        $montant = $request->input('montant');
        $method = $request->input('method');

        // Identifier le guard actif
        switch (true) {
            case auth()->guard('etudiant')->check():
                $user = auth()->guard('etudiant')->user();
                $type = 'etudiant';
                break;

            case auth()->guard('formateur')->check():
                $user = auth()->guard('formateur')->user();
                $type = 'formateur';
                break;

            default:
                return back()->with('error', 'Vous devez être connecté pour effectuer un paiement.');
        }

        switch ($method) {
            case 'orange_money':
                
                $this->processOrangeMoney($formationId, $montant, $user, $type);
                if ($type == 'etudiant') {
                    // L'étudiant est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                } elseif ($type == 'formateur' && $user->id !== Formation::find($formationId)->formateur->id) {
                    // Un formateur est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                }

                break;

            case 'moov_money':
                
                $this->processMoovMoney($formationId, $montant, $user, $type);
                if ($type == 'etudiant') {
                    // L'étudiant est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                } elseif ($type == 'formateur' && $user->id !== Formation::find($formationId)->formateur->id) {
                    // L'étudiant est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                }

                break;

            case 'telecel_money':
                $this->processTelecelMoney($formationId, $montant, $user, $type);
                if ($type == 'etudiant') {
                    // L'étudiant est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                } elseif ($type == 'formateur' && $user->id !== Formation::find($formationId)->formateur->id) {
                    // Un formateur est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                }
                break;

            case 'sank_money':
               
                $this->processSankMoney($formationId, $montant, $user, $type);

                if ($type == 'etudiant') {
                    // L'étudiant est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                } elseif ($type == 'formateur' && $user->id !== Formation::find($formationId)->formateur->id) {
                    // Un formateur est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                }
                // return back()->with('success', 'Paiement réussi via Sank Money.');
                break;

            case 'coris_money':
                
                $this->processCorisMoney($formationId, $montant, $user, $type);
                if ($type == 'etudiant') {
                    // L'étudiant est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                } elseif ($type == 'formateur' && $user->id !== Formation::find($formationId)->formateur->id) {
                    // Un formateur est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                }
                break;

            case 'wave':
                
                $this->processWave($formationId, $montant, $user, $type);
                if ($type == 'etudiant') {
                     // L'étudiant est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                } elseif ($type == 'formateur' && $user->id !== Formation::find($formationId)->formateur->id) {
                    // Un formateur est l'acheteur
                    $this->updateFormateurSolde($formationId, $montant);
                }
                break;

            default:
                return back()->with('error', 'Méthode de paiement non reconnue.');
        }

        // dd(session()->all());

        if ($type == 'etudiant') {
            // session()->flash('success', 'Paiement effectué avec succès.');
            // // dd(session()->all());
            // return redirect()->route('etudiant.cours')->with('debug', 'Debugging Redirection'); // Ajout temporaire
            return redirect()->route('formations.list')->with('success', 'Paiement effectué avec succès.');

        } 
        elseif ($type == 'formateur' && $user->id !== Formation::find($formationId)->formateur->id) {
            return redirect()->route('formateur.formations')->with('success', 'Paiement effectué avec succès.');
        }
    }

    // Exemple de sous-méthodes pour chaque paiement
    private function processOrangeMoney($formationId, $montant, $user, $type)
    {
        $formation = Formation::findOrFail($formationId);

        if ($montant < $formation->prix) {
            throw new \Exception("Le montant saisi est insuffisant pour cette formation.");
        }

        // Simuler une réponse d'API CorisMoney (exemple)
        $response = ['status' => 'success', 'message' => 'Paiement approuvé.'];

        switch ($response['status']) {
            case 'success':
                // Enregistrer le paiement dans la base de données
                Paiement::create([
                    'formation_id' => $formationId,
                    'montant' => $montant,
                    'methode' => 'orange_money',
                    'status' => 'validé',
                    'date' => now(),
                    'commande_id' => null,
                    'etudiant_id' => $type === 'etudiant' ? $user->id : null,
                    'formateur_id' => $type === 'formateur' ? $user->id : null,
                ]);

                Log::info("Paiement Orange Money réussi par {$type} ID: {$user->nom}");
                break;

            default:
                throw new \Exception("Échec du paiement : " . $response['message']);
        }
    }

    private function processMoovMoney($formationId, $montant, $user, $type)
    {
        $formation = Formation::findOrFail($formationId);

        if ($montant < $formation->prix) {
            throw new \Exception("Le montant saisi est insuffisant pour cette formation.");
        }

        // Simuler une réponse d'API CorisMoney (exemple)
        $response = ['status' => 'success', 'message' => 'Paiement approuvé.'];

        switch ($response['status']) {
            case 'success':
                // Enregistrer le paiement dans la base de données
                Paiement::create([
                    'formation_id' => $formationId,
                    'montant' => $montant,
                    'methode' => 'moov_money',
                    'status' => 'validé',
                    'date' => now(),
                    'commande_id' => null,
                    'etudiant_id' => $type === 'etudiant' ? $user->id : null,
                    'formateur_id' => $type === 'formateur' ? $user->id : null,
                ]);

                Log::info("Paiement Moov Money réussi par {$type} ID: {$user->nom}");
                break;

            default:
                throw new \Exception("Échec du paiement : " . $response['message']);
        }
    }

    private function processTelecelMoney($formationId, $montant, $user, $type)
    {
        $formation = Formation::findOrFail($formationId);

        if ($montant < $formation->prix) {
            throw new \Exception("Le montant saisi est insuffisant pour cette formation.");
        }

        // Simuler une réponse d'API CorisMoney (exemple)
        $response = ['status' => 'success', 'message' => 'Paiement approuvé.'];

        switch ($response['status']) {
            case 'success':
                // Enregistrer le paiement dans la base de données
                Paiement::create([
                    'formation_id' => $formationId,
                    'montant' => $montant,
                    'methode' => 'telecel_money',
                    'status' => 'validé',
                    'date' => now()->format('Y-m-d H:i:s'),
                    'commande_id' => null,
                    'etudiant_id' => $type === 'etudiant' ? $user->id : null,
                    'formateur_id' => $type === 'formateur' ? $user->id : null,
                ]);

                Log::info("Paiement Telecel Money réussi par {$type} ID: {$user->nom}");
                break;

            default:
                throw new \Exception("Échec du paiement : " . $response['message']);
        }
    }

    private function processSankMoney($formationId, $montant, $user, $type)
    {
        $formation = Formation::findOrFail($formationId);

        if ($montant < $formation->prix) {
            throw new \Exception("Le montant saisi est insuffisant pour cette formation.");
        }

        // Simuler une réponse d'API CorisMoney (exemple)
        $response = ['status' => 'success', 'message' => 'Paiement approuvé.'];

        switch ($response['status']) {
            case 'success':
                // Enregistrer le paiement dans la base de données
                Paiement::create([
                    'formation_id' => $formationId,
                    'montant' => $montant,
                    'methode' => 'sank_money',
                    'status' => 'validé',
                    'date' => now(),
                    'commande_id' => null,
                    'etudiant_id' => $type === 'etudiant' ? $user->id : null,
                    'formateur_id' => $type === 'formateur' ? $user->id : null,
                ]);

                Log::info("Paiement SankMoney réussi par {$type} ID: {$user->nom}");
                break;

            default:
                throw new \Exception("Échec du paiement : " . $response['message']);
        }
    }


    private function processCorisMoney($formationId, $montant, $user, $type)
    {
        $formation = Formation::findOrFail($formationId);

        if ($montant < $formation->prix) {
            throw new \Exception("Le montant saisi est insuffisant pour cette formation.");
        }

        // Simuler une réponse d'API CorisMoney (exemple)
        $response = ['status' => 'success', 'message' => 'Paiement approuvé.'];

        switch ($response['status']) {
            case 'success':
                // Enregistrer le paiement dans la base de données
                Paiement::create([
                    'formation_id' => $formationId,
                    'montant' => $montant,
                    'methode' => 'coris_money',
                    'status' => 'validé',
                    'date' => now(),
                    'commande_id' => null,
                    'etudiant_id' => $type === 'etudiant' ? $user->id : null,
                    'formateur_id' => $type === 'formateur' ? $user->id : null,
                ]);

                Log::info("Paiement CorisMoney réussi par {$type} ID: {$user->nom}");
                break;

            default:
                throw new \Exception("Échec du paiement : " . $response['message']);
        }
    }

    private function processWave($formationId, $montant, $user, $type)
    {
        $formation = Formation::findOrFail($formationId);

        if ($montant < $formation->prix) {
            throw new \Exception("Le montant saisi est insuffisant pour cette formation.");
        }

        // Simuler une réponse d'API CorisMoney (exemple)
        $response = ['status' => 'success', 'message' => 'Paiement approuvé.'];

        switch ($response['status']) {
            case 'success':
                // Enregistrer le paiement dans la base de données
                Paiement::create([
                    'formation_id' => $formationId,
                    'montant' => $montant,
                    'methode' => 'wave',
                    'status' => 'validé',
                    'date' => now(),
                    'commande_id' => null,
                    'etudiant_id' => $type === 'etudiant' ? $user->id : null,
                    'formateur_id' => $type === 'formateur' ? $user->id : null,
                ]);

                Log::info("Paiement wave réussi par {$type} ID: {$user->nom}");
                break;

            default:
                throw new \Exception("Échec du paiement : " . $response['message']);
        }
    }

    private function updateFormateurSolde($formationId, $montant)
    {
    
        $formation = Formation::findOrFail($formationId);
        $formateur = $formation->formateur;
        $fpourcentage = $formateur->pourcentage;
        $fpourcent = $fpourcentage/100;

        // pourcentage de l'application
        // $pourcentageApp = 0.10;

        $partFormateur = $montant * (1 - $fpourcent);  // Part du formateur
        $partApp = $montant * $fpourcent;  // Part de l'application

        // Ajout de la part au solde du formateur
        $formateur->solde += $partFormateur;
        $formateur->save();

        // Ajouter une nouvelle entrée dans la caisse du systeme
        SystemeCaise::create([
            'formation_id' => $formationId,
            'montant' => $partApp,
        ]);
    }

}
