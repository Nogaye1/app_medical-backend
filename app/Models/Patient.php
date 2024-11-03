<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['utilisateur_id'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function antecedentsMedicaux()
    {
        return $this->hasMany(AntecedentMedical::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}