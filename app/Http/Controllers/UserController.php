<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Récupérer tous les utilisateurs
    public function index()
    {
        return User::all();
    }

    // Ajouter un nouvel utilisateur (inscription)
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'dateNaissance' => 'required|date',
            'adresse' => 'required|string',
            'telephone' => 'required|string|unique:users,telephone',
            'email' => 'required|email|unique:users,email',
            'specialite' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        return response()->json(['user' => $user->makeHidden('password'), 'message' => 'Utilisateur inscrit avec succès'], 201);
    }

    // Connexion de l'utilisateur
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Les identifiants fournis sont incorrects.'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 200);
    }

    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie et token révoqué'], 200);
    }

    // Récupérer un utilisateur spécifique
    public function show($id)
    {
        return User::with(['profil', 'rendezVous', 'antecedentsMedicaux', 'paiements'])
                    ->findOrFail($id)
                    ->makeHidden('password');
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'dateNaissance' => 'date',
            'adresse' => 'string',
            'telephone' => 'string|unique:users,telephone,' . $id,
            'email' => 'email|unique:users,email,' . $id,
            'specialite' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json($user->makeHidden('password'), 200);
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès'], 200);
}
}