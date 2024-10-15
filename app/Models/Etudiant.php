<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Etudiant extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'image',
        'status',
    ];

    // public function formations()
    // {
    //     return $this->belongsToMany(Formation::class, 'etudiant_formation')
    //         ->withPivot('status', 'date_commande')
    //         ->withTimestamps();
    // }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function invitationsEnvoyees()
    {
        return $this->hasMany(Invitation::class, 'inviteur_id');
    }

    public function invitationsRecues()
    {
        return $this->hasMany(Invitation::class, 'invite_id');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
