<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RelacionNMController;

Route::get('/', function () {
    return 'Ejercicio resuelto de Eloquent de una relación varios a varios.';
});

Route::get('/crear-autores-libros', [RelacionNMController::class, 'agregar'])
    ->name('insertar');

Route::get('/autores-libros', [RelacionNMController::class, 'ver'])
    ->name('leer');

Route::get('/libros-autores', [RelacionNMController::class, 'mostrar'])
    ->name('exponer');