<?php
// app/Http/Controllers/AntecedentMedicalController.php

namespace App\Http\Controllers;

use App\Models\AntecedentMedical;
use Illuminate\Http\Request;

class AntecedentMedicalController extends Controller
{
    public function index()
    {
        return AntecedentMedical::with('patient')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'dateDebut' => 'required|date',
            'dateFin' => 'nullable|date',
            'heureDebut' => 'required|date_format:H:i',
            'heureFin' => 'nullable|date_format:H:i',
            'motif' => 'required|string',
        ]);

        return AntecedentMedical::create($validatedData);
    }

    public function show($id)
    {
        return AntecedentMedical::with('patient')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $antecedent = AntecedentMedical::findOrFail($id);

        $validatedData = $request->validate([
            'patient_id' => 'exists:patients,id',
            'dateDebut' => 'date',
            'dateFin' => 'nullable|date',
            'heureDebut' => 'date_format:H:i',
            'heureFin' => 'nullable|date_format:H:i',
            'motif' => 'string',
        ]);

        $antecedent->update($validatedData);

        return $antecedent;
    }

    public function destroy($id)
    {
        $antecedent = AntecedentMedical::findOrFail($id);
        $antecedent->delete();

        return response()->json(['message' => 'Antécédent médical supprimé avec succès']);
    }    
}