<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant', 'dateFacture', 'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }    
}