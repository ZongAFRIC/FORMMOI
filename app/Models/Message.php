<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'formateur_id',
        'contenu_message',
        'date_envoi',
        'date_lecture'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }
}
