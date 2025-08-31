<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Avis;
use App\Models\Note;
use App\Models\Commentaire;
use App\Models\Chapitre;

class AvisController extends Controller
{

    public function noter(Request $request, $chapitreId)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
        ]);

        // Vérifier si l'utilisateur a déjà noté ce chapitre
        $avis = Avis::where('chapitre_id', $chapitreId)
            ->where('utilisateur_id', auth()->id())
            ->where('type', 'Note')
            ->first();

        if ($avis) {
            // Mise à jour de la note existante
            $avis->update([
                'note' => $request->note,
            ]);
        } else {
            // Création d'une nouvelle note
            Avis::create([
                'note' => $request->note,
                'commentaire' => null,
                'type' => 'Note',
                'chapitre_id' => $chapitreId,
                'utilisateur_id' => auth()->id(),
                'type_utilisateur' => auth()->guard('formateur')->check() ? 'formateur' : 'etudiant',
            ]);
        }

        return back()->with('success', 'Votre note a été enregistrée.');
    }


    public function commenter(Request $request, $chapitreId)
    {
        $request->validate([
            'commentaire' => 'required|string',
        ]);
    
        // Vérifier si l'utilisateur a déjà commenté ce chapitre
        $avis = Avis::where('chapitre_id', $chapitreId)
            ->where('utilisateur_id', auth()->id())
            ->where('type', 'Commentaire')
            ->first();
    
        if ($avis) {
            // Mise à jour du commentaire existant
            $avis->update([
                'commentaire' => $request->commentaire,
            ]);
        } else {
            // Création d'un nouveau commentaire
            Avis::create([
                'note' => null,
                'commentaire' => $request->commentaire,
                'type' => 'Commentaire',
                'chapitre_id' => $chapitreId,
                'utilisateur_id' => auth()->id(),
                'type_utilisateur' => auth()->guard('formateur')->check() ? 'formateur' : 'etudiant',
            ]);
        }
    
        return back()->with('success', 'Votre commentaire a été enregistré.');
    }
    

}
