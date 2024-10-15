<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use App\Models\Formation;


class Avis extends Model
{
    use HasFactory;
    protected $fillable = [
        'etudiant_id',
        'formation_id',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
