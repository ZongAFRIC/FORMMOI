<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [ 'titre', 'categorie', 'description','duree', 'video', 'pdf', 'image', 'prix','formateur_id','published'];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
    

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class , 'categorie', 'nom_categorie');
    }

    // public function commandes()
    // {
    //     return $this->belongsToMany(Commande::class, 'commande_formation');
    // }

    // public function commandes()
    // {
    //     return $this->belongsToMany(Commande::class, 'commande_formation', 'formation_id', 'commande_id')
    //                 ->withPivot('quantite') // Si vous gérez des quantités
    //                 ->withTimestamps();
    // }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_formation', 'formation_id', 'commande_id')->withPivot('quantite');
    }

    public function moyenneAvis()
    {
        return $this->avis()->avg('note');
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'formation_etudiant', 'formation_id', 'etudiant_id')->withTimestamps();
    }


}
