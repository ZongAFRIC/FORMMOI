<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Etudiant extends Authenticatable
{
    use HasFactory,SoftDeletes;
    
    protected $dates = ['deleted_at']; // Soft delete
    
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'image',
        'status',
    ];

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // public function invitationsEnvoyees()
    // {
    //     return $this->hasMany(Invitation::class, 'inviteur_id');
    // }

    // public function invitationsRecues()
    // {
    //     return $this->hasMany(Invitation::class, 'invite_id');
    // }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'etudiant_id');
    }


    public function formationsAchetees()
    {
        return $this->belongsToMany(Formation::class, 'paiements', 'etudiant_id', 'formation_id')
                    ->withPivot('montant', 'methode', 'status', 'date') 
                    ->wherePivot('status', 'validé'); // Filtre pour n'afficher que les formations payées
    }


    public function messagesEnvoyes()
    {
        return $this->morphMany(Message::class, 'expediteur');
    }

    public function messagesRecus()
    {
        return $this->morphMany(Message::class, 'recepteur');
    }

    public function chapitresCompletes()
    {
        return $this->belongsToMany(Chapitre::class, 'chapitre_user')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }

    public function chapitres()
    {
        return $this->morphedByMany(Chapitre::class, 'user', 'chapitre_user')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

}
