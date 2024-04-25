<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\AnuncioController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/endereco', EnderecoController::class);
Route::resource('/anuncio', AnuncioController::class);