<?php
// app/Http/Controllers/FactureController.php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        return Facture::with('paiement')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paiement_id' => 'required|exists:paiements,id',
            'montant' => 'required|numeric',
            'dateFacture' => 'required|date',
        ]);

        return Facture::create($validatedData);
    }

    public function show($id)
    {
        return Facture::with('paiement')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $facture = Facture::findOrFail($id);

        $validatedData = $request->validate([
            'paiement_id' => 'exists:paiements,id',
            'montant' => 'numeric',
            'dateFacture' => 'date',
        ]);

        $facture->update($validatedData);

        return $facture;
    }

    public function destroy($id)
    {
        $facture = Facture::findOrFail($id);
        $facture->delete();

        return response()->json(['message' => 'Facture supprimée avec succès']);
    }    
}