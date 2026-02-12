<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;

// Auth routes (public - no authentication)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Auth routes (protected - need token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

// Product Routes - Tukar jadi protected routes ikut roles dan permissions
    Route::get('/products', [ProductController::class, 'index'])
        ->middleware('permission:products-view');
    
    Route::get('/products/{id}', [ProductController::class, 'show'])
        ->middleware('permission:products-view');
    
    Route::post('/products', [ProductController::class, 'store'])
        ->middleware('permission:products-create');
    
    Route::put('/products/{id}', [ProductController::class, 'update'])
        ->middleware('permission:products-update');
    
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->middleware('permission:products-delete');
});

