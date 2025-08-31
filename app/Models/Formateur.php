<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Formateur extends Authenticatable
{
    use HasFactory, Notifiable , SoftDeletes;

    protected $dates = ['deleted_at']; // Soft delete

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'image',
        'cv',
        'attestation',
        'status',
        'is_validated',
        'bio',
        'solde',
        'username',
        'pourcentage',
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class, 'formateur_id');
    }

    public function compteFormateur()
    {
        return $this->hasOne(CompteFormateur::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'formateur_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function mesformationsAchetees()
    {
        return $this->belongsToMany(Formation::class, 'paiements', 'formateur_id', 'formation_id')
                    ->withPivot('montant', 'methode', 'status', 'date') 
                    ->wherePivot('status', 'validé');
    }

    public function messagesEnvoyes()
    {
        return $this->morphMany(Message::class, 'expediteur');
    }

    public function messagesRecus()
    {
        return $this->morphMany(Message::class, 'recepteur');
    }

    public function chapitres()
    {
        return $this->morphedByMany(Chapitre::class, 'user', 'chapitre_user')
            ->withPivot('completed_at')
            ->withTimestamps();
    }
    
    public function chapitresCompletes()
    {
        return $this->belongsToMany(Chapitre::class, 'chapitre_user')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

}
