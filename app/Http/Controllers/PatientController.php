<?php
// app/Http/Controllers/PatientController.php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return Patient::with(['antecedents', 'paiements'])->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
        ]);

        return Patient::create($validatedData);
    }

    public function show($id)
    {
        return Patient::with(['antecedents', 'paiements'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validatedData = $request->validate([
            'utilisateur_id' => 'exists:utilisateurs,id',
        ]);

        $patient->update($validatedData);

        return $patient;
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['message' => 'Patient supprimé avec succès']);
}
}