<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ===========================================
// TUGASAN #16 - SAIFULLAH
// NAMA: Saifullah
// EMAIL: fdsstudio583@gmail.com
// TARIKH: 12 Februari 2026
// ===========================================
Route::get('/posts/recent', [PostController::class, 'recent'])
     ->name('posts.recent');
// ===========================================