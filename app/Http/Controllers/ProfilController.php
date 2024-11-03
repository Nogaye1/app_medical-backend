<?php
// app/Http/Controllers/ProfilController.php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return Profil::with(['utilisateur', 'role'])->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        return Profil::create($validatedData);
    }

    public function show($id)
    {
        return Profil::with(['utilisateur', 'role'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::findOrFail($id);

        $validatedData = $request->validate([
            'utilisateur_id' => 'exists:utilisateurs,id',
            'role_id' => 'exists:roles,id',
        ]);

        $profil->update($validatedData);

        return $profil;
    }

    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);
        $profil->delete();

        return response()->json(['message' => 'Profil supprimé avec succès']);
    }    
}