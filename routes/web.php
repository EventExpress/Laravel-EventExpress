<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/usuario', UsuarioController::class);

Route::resource('/categoria', CategoriaController::class);

