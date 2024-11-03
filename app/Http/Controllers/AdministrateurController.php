<?php
// app/Http/Controllers/AdministrateurController.php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;

class AdministrateurController extends Controller
{
    public function index()
    {
        return Administrateur::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
        ]);

        return Administrateur::create($validatedData);
    }

    public function show($id)
    {
        return Administrateur::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $administrateur = Administrateur::findOrFail($id);

        $validatedData = $request->validate([
            'utilisateur_id' => 'exists:utilisateurs,id',
        ]);

        $administrateur->update($validatedData);

        return $administrateur;
    }

    public function destroy($id)
    {
        $administrateur = Administrateur::findOrFail($id);
        $administrateur->delete();

        return response()->json(['message' => 'Administrateur supprimé avec succès']);
    }
}