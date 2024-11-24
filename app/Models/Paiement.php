<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

   protected $fillable = ['montant', 'date', 'methode', 'status', 'commande_id', 'formation_id', 'etudiant_id'];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }
}
