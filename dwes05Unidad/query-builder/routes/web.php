<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CancionController;

Route::get('/', [CancionController::class, 'portada'])
    ->name('principal');

Route::get('/temas', [CancionController::class, 'composiciones'])
    ->name('obras-musicales');

Route::get('/agregar', [CancionController::class, 'crear'])
    ->name('anadir');

Route::post('/agregar', [CancionController::class, 'almacenar'])
    ->name('guardar');