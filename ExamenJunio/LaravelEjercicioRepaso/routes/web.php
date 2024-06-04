<?php

use App\Http\Controllers\LibroController;
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

Route::get('/', [LibroController::class, 'listarLibrosEntreDosYears'])->name('mostrarLibros'); // puede llevar parámetros maxYear y minYear
// Ejemplo de URL: http://localhost:8000/?minYear=2000&maxYear=2010

Route::get('/nuevo', [LibroController::class, 'mostrarFormNuevoLibro'])->name('formNuevoLibro');

Route::post('/libro/nuevo', [LibroController::class, 'crearNuevoLibro'])->name('crearLibro');
