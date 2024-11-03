<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialite', 'utilisateur_id'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }    
}