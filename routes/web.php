<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/usuario', UsuarioController::class);

Route::resource('/categoria', CategoriaController::class);

Route::resource('/endereco', EnderecoController::class);

Route::resource('/anuncio', AnuncioController::class);

