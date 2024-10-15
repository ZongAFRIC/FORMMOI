<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteFormateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'solde',
        'formateur_id',
    ];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }
}
