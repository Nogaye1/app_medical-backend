<?php
// app/Http/Controllers/RoleController.php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'roleName' => 'required|string|max:255|unique:roles,roleName',
        ]);

        return Role::create($validatedData);
    }

    public function show($id)
    {
        return Role::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validatedData = $request->validate([
            'roleName' => 'string|max:255|unique:roles,roleName,' . $id,
        ]);

        $role->update($validatedData);

        return $role;
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['message' => 'Rôle supprimé avec succès']);
    }    
}