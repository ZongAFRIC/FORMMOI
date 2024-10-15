<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = ['avis_id', 'commentaire'];

    public function avis()
    {
        return $this->belongsTo(Avis::class);
    }
}
