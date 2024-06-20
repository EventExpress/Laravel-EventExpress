<?php

use App\Http\Controllers\AdicionalController;
use App\Http\Controllers\AgendadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\UsuarioController;
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
    Route::get('anuncio/{id}/edit', [AnuncioController::class, 'edit'])->name('anuncio.edit');
    Route::put('anuncio/{id}', [AnuncioController::class, 'update'])->name('anuncio.update');
    Route::delete('anuncio/{id}', [AnuncioController::class, 'destroy'])->name('anuncio.destroy');
    Route::get('anuncio/{id}', [AnuncioController::class, 'show'])->name('anuncio.show');
    Route::get('/anuncio', [AnuncioController::class, 'index'])->name('anuncio.index');

    Route::get('/agendado', [AgendadoController::class, 'index'])->name('agendado.index');
    Route::get('anuncio/{anuncioId}/reservar', [AgendadoController::class, 'create'])->name('agendado.create');
    Route::post('agendado', [AgendadoController::class, 'store'])->name('agendado.store');
    Route::get('agendado/{id}/edit', [AgendadoController::class, 'edit'])->name('agendado.edit');
    Route::put('agendado/{id}', [AgendadoController::class, 'update'])->name('agendado.update');
    Route::delete('agendado/{id}', [AgendadoController::class, 'destroy'])->name('agendado.destroy');
    Route::get('agendado/{id}', [AgendadoController::class, 'show'])->name('agendado.show');

    Route::resource('/usuario', UsuarioController::class);

    Route::resource('/categoria', CategoriaController::class);

    Route::resource('/endereco', EnderecoController::class);

    Route::resource('/adicional', AdicionalController::class);
});


require __DIR__.'/auth.php';
