<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;

Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
