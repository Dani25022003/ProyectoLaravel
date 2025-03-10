<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeFormController;
use App\Http\Controllers\AnimeStoreController;
use App\Http\Controllers\AnimeDeleteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RatingController;

Route::view('/', 'welcome'); // Muestra la vista `resources/views/welcome.blade.php`

// Rutas de Anime
Route::get('/animes', [AnimeController::class, 'index'])->name('animes.index');
Route::get('/animes/create', [AnimeFormController::class, 'create'])->name('animes.create');
Route::get('/animes/{id}/edit', [AnimeFormController::class, 'edit'])->name('animes.edit');
Route::put('/animes/{id}', [AnimeStoreController::class, 'update'])->name('animes.update');
Route::post('/animes', [AnimeStoreController::class, 'store'])->name('animes.store');
Route::get('/animes/{id}', [AnimeController::class, 'show'])->name('animes.show');
Route::delete('/animes/{id}', [AnimeDeleteController::class, 'destroy'])->name('animes.destroy');

// Rutas de autenticación
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/animes/{anime}/rate', [AnimeController::class, 'rate'])->name('rate.anime');




