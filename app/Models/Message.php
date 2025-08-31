<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu',
        'expediteur_id',
        'recepteur_id',
        'expediteur_type',
        'recepteur_type',
        'lu'
    ];

    public function expediteur()
    {
        return $this->morphTo();
    }

    public function recepteur()
    {
        return $this->morphTo();
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }
}
