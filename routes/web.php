<?php

use App\Http\Controllers\LocadorController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/usuario', UsuarioController::class);
Route::resource('/locador',LocadorController::class);
