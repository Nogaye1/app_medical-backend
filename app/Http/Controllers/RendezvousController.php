<?php
// app/Http/Controllers/RendezvousController.php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    public function index()
    {
        return Rendezvous::with(['patient', 'medecin'])->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'dateHeure' => 'required|datetime',
            'motif' => 'required|string',
        ]);

        return Rendezvous::create($validatedData);
    }

    public function show($id)
    {
        return Rendezvous::with(['patient', 'medecin'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $rendezvous = Rendezvous::findOrFail($id);

        $validatedData = $request->validate([
            'patient_id' => 'exists:patients,id',
            'medecin_id' => 'exists:medecins,id',
            'dateHeure' => 'datetime',
            'motif' => 'string',
        ]);

        $rendezvous->update($validatedData);

        return $rendezvous;
    }

    public function destroy($id)
    {
        $rendezvous = Rendezvous::findOrFail($id);
        $rendezvous->delete();

        return response()->json(['message' => 'Rendez-vous supprimé avec succès']);
    }    
}