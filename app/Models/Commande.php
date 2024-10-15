<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [ 'quantite', 'total', 'status', 'etudiant_id'];


    public function etutiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
