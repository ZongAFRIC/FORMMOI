<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Chapitre extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'video', 'formation_id'];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }


    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'chapitre_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'chapitre_id');
    }

    public function etudiantsCompletes()
    {
        return $this->belongsToMany(Etudiant::class, 'chapitre_etudiant')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }

    public function utilisateursCompletes()
    {
        return $this->morphToMany(User::class, 'user', 'chapitre_utilisateur')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }
    
     public function utilisateurs()
    {
        return $this->morphToMany(User::class, 'user', 'chapitre_utilisateur')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    public function estTerminePar($user)
    {
        return DB::table('chapitre_user')
            ->where('chapitre_id', $this->id)
            ->where('user_id', $user->id)
            ->where('user_type', get_class($user))
            ->exists();
    }



    public function scopeWithFormation($query)
    {
        return $query->with('formation');
    }

    public function scopeWithAvis($query)
    {
        return $query->with('avis');
    }

    public function scopeWithCommentaires($query)
    {
        return $query->with('commentaires');
    }

    public function scopeWithNotes($query)
    {
        return $query->with('notes');
    }

}
