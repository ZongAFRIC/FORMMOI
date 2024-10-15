<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [ 'montant', 'date', 'methode','status', 'commende_id'];


    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
