<?php

use App\Http\Controllers\UbicacionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('ubicaciones', [UbicacionController::class, 'index'])->name('index');

Route::post('ubicaciones/store', [UbicacionController::class, 'store']);

Route::get('ubicaciones/create', [UbicacionController::class, 'create'])->name('crear_ubicacion');
