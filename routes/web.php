<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('anuncio/create', [AnuncioController::class, 'create'])->name('anuncio.create');
    Route::post('anuncio', [AnuncioController::class, 'store'])->name('anuncio.store');
    Route::get('anuncio/edit', [AnuncioController::class, 'edit'])->name('anuncio.edit');
    Route::put('anuncio/{id}', [AnuncioController::class, 'update'])->name('anuncio.update');
    Route::delete('anuncio/{id}', [AnuncioController::class, 'destroy'])->name('anuncio.destroy');
    Route::get('anuncio/{id}', [AnuncioController::class, 'show'])->name('anuncio.show');
    Route::get('/anuncio', [AnuncioController::class, 'index'])->name('anuncio.index');
});


require __DIR__.'/auth.php';
