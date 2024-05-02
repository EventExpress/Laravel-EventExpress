<?php

use App\Http\Controllers\AdicionalController;
use App\Http\Controllers\AgendadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('anuncio/{usuario}/create', [AnuncioController::class, 'create'])->name('anuncio.create');
Route::post('anuncio', [AnuncioController::class, 'store'])->name('anuncio.store');
Route::get('/anuncio', [AnuncioController::class, 'index'])->name('anuncio.index');

Route::get('anuncio/{usuario}/edit', [AnuncioController::class, 'edit'])->name('anuncio.edit');
Route::put('anuncio/{usuario}', [AnuncioController::class, 'update'])->name('anuncio.update');
Route::delete('anuncio/{usuario}', [AnuncioController::class, 'destroy'])->name('anuncio.destroy');

//Route::resource('/anuncio', AnuncioController::class);

Route::resource('/usuario', UsuarioController::class);

Route::resource('/categoria', CategoriaController::class);

Route::resource('/endereco', EnderecoController::class);

Route::resource('/agendado', AgendadoController::class);

Route::resource('/adicional', AdicionalController::class);
