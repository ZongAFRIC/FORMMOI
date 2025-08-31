<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppCaisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'formation_id',
        'montant',
        'date_transaction',
    ];

    // Relation avec le modèle Formation
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
