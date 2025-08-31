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

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'formation_id');
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

    public function moyenneAvis()
    {
        return $this->avis()->avg('note');
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'paiements', 'formation_id', 'etudiant_id')
                    ->withPivot('montant', 'methode', 'status', 'date');
    }


    // public function getNombreChapitresTerminesAttribute()
    // {
    //     return $this->chapitres()->where('termine', true)->count();
    // }

    // public function getNombreChapitresAttribute()
    // {
    //     return $this->chapitres()->count();
    // }

    // public function getProgressionAttribute()
    // {
    //     $nombreChapitresTermines = $this->getNombreChapitresTerminesAttribute();
    //     $nombreChapitres = $this->getNombreChapitresAttribute();
    //     return $nombreChapitres > 0 ? round(($nombreChapitresTermines / $nombreChapitres) * 100) : 0;
    // }

    // public function getStatusAttribute()
    // {
    //     return $this->getNombreChapitresTerminesAttribute() === $this->getNombreChapitresAttribute() ? 'Terminé' : 'En cours';
    // }
}
