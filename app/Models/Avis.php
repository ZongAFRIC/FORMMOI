<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Chapitre;


class Avis extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'formation_id',
        'utilisateur_id',
        'type_utilisateur',
        'chapitre_id',
        'note',
        'commentaire',
        'type',
        'formation_id',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function utilisateur()
    {
        if ($this->type_utilisateur === 'etudiant') {
            return $this->belongsTo(Etudiant::class, 'utilisateur_id');
        } else {
            return $this->belongsTo(Formateur::class, 'utilisateur_id');
        }
    }

    public function commentaire()
    {
        return $this->hasOne(Commentaire::class);
    }

    public function note()
    {
        return $this->hasOne(Note::class);
    }

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }
}
