<?php 
// app/Http/Controllers/PaiementController.php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        return Paiement::with('patient')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'montant' => 'required|numeric',
            'datePaiement' => 'required|date',
        ]);

        return Paiement::create($validatedData);
    }

    public function show($id)
    {
        return Paiement::with('patient')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $paiement = Paiement::findOrFail($id);

        $validatedData = $request->validate([
            'patient_id' => 'exists:patients,id',
            'montant' => 'numeric',
            'datePaiement' => 'date',
        ]);

        $paiement->update($validatedData);

        return $paiement;
    }

    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return response()->json(['message' => 'Paiement supprimé avec succès']);
    }    
}