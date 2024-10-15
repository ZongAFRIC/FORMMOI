<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [ 'titre', 'categorie', 'description','duree', 'video', 'pdf', 'image', 'prix','formateur_id'];

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
        return $this->belongsTo(Categorie::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class);
    }

    public function moyenneAvis()
    {
        return $this->avis()->avg('note');
    }
}
