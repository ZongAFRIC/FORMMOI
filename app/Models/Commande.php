<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [ 'total', 'status','type_utilisateur','etudiant_id','formateur_id'];


    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'formateur_id'); // On réutilise `etudiant_id` pour la clé étrangère
    }

    // public function formations()
    // {
    //     return $this->belongsToMany(Formation::class);
    // }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    // public function formations()
    // {
    //     return $this->belongsToMany(Formation::class, 'commande_formation', 'commande_id', 'formation_id')
    //                 ->withPivot('quantite') // Si vous gérez des quantités
    //                 ->withTimestamps();
    // }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'commande_formation', 'commande_id', 'formation_id')->withPivot('quantite');
    }

    /**
     * Déterminer si la commande appartient à un étudiant ou un formateur.
     */
    // public function utilisateur()
    // {
    //     if ($this->type_utilisateur == 'etudiant') {
    //         return $this->belongsTo(Etudiant::class, 'utilisateur_id');
    //     } elseif ($this->type_utilisateur == 'formateur') {
    //         return $this->belongsTo(Formateur::class, 'utilisateur_id');
    //     }
    // }

    /**
     * Vérifie si une commande est payée.
     */
    public function estPayee()
    {
        return $this->status === 'payée';
    }

}
