<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['avis_id', 'valeur'];

    public function avis()
    {
        return $this->belongsTo(Avis::class);
    }
}
