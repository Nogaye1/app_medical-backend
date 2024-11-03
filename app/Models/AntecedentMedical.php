<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedentMedical extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateDebut', 'dateFin', 'heureDebut', 'heureFin', 'motif', 'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }    
}