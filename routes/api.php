<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AuthController;


// Giriş ve kayıt işlemleri (giriş gerektirmez)
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
// Giriş gerektiren işlemler (korumalı rotalar)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 🔥 HAREKET ADI (title) ile select için
    Route::get('/workouts/list', [WorkoutController::class, 'list']);

    // Diğer kaynaklar
    Route::apiResource('workouts', WorkoutController::class);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('progress', ProgressController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});

