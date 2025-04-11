<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\SuscriptionController;

// AUTH
Route::post('/auth/signup', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // AUTH
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::patch('/auth/update-data/{id}', [AuthController::class, 'updateData']);
    Route::patch('/auth/update-password/{id}', [AuthController::class, 'updatePassword']);

    // VERIFICATIONS
    Route::post('/verifications/generate', [VerificationController::class, 'generate']);
    Route::post('/verifications/validate', [VerificationController::class, 'validate']);

    // ROLES
    Route::apiResource('roles', RoleController::class);

    // SUSCRIPTIONS
    Route::apiResource('suscriptions', SuscriptionController::class);
    
});

