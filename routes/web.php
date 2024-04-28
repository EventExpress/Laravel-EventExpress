<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/create', [UsuarioController::class, 'store']);

Route::resource('/usuario', UsuarioController::class);

Route::resource('/categoria', CategoriaController::class);

Route::resource('/endereco', EnderecoController::class);

Route::resource('/anuncio', AnuncioController::class);

