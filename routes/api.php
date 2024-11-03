<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\AntecedentMedicalController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdministrateurController;

// Route pour l'inscription des utilisateurs
Route::post('/register', [UserController::class, 'register']);

// Route pour la connexion des utilisateurs
Route::post('/login', [UserController::class, 'login']);

// Routes protégées par Sanctum pour la déconnexion et les données de l'utilisateur
Route::middleware('auth:sanctum')->group(function () {
    // Déconnexion
    Route::post('/logout', [UserController::class, 'logout']);

    // Route pour récupérer l'utilisateur authentifié
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Routes de l'API protégées par Sanctum
    Route::apiResource('users', UserController::class);
    Route::apiResource('profils', ProfilController::class);
    Route::apiResource('rendezvous', RendezVousController::class);
    Route::apiResource('antecedents', AntecedentMedicalController::class);
    Route::apiResource('paiements', PaiementController::class);
    Route::apiResource('factures', FactureController::class);
    Route::apiResource('medecins', MedecinController::class);
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('administrateurs', AdministrateurController::class);
});