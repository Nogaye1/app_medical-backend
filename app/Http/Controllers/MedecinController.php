<?php
// app/Http/Controllers/MedecinController.php

namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    public function index()
    {
        return Medecin::with('rendezvous')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'specialite' => 'required|string|max:255',
        ]);

        return Medecin::create($validatedData);
    }

    public function show($id)
    {
        return Medecin::with('rendezvous')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $medecin = Medecin::findOrFail($id);

        $validatedData = $request->validate([
            'utilisateur_id' => 'exists:utilisateurs,id',
            'specialite' => 'string|max:255',
        ]);

        $medecin->update($validatedData);

        return $medecin;
    }

    public function destroy($id)
    {
        $medecin = Medecin::findOrFail($id);
        $medecin->delete();

        return response()->json(['message' => 'Médecin supprimé avec succès']);
    }    
}