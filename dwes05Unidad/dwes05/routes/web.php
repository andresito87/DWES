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

// Ruta principal
Route::get('/', function () {
    return view('principal');
})->name('principal');

// Ruta para mostrar la lista de ubicaciones
Route::get('ubicaciones', [UbicacionController::class, 'index'])->name('index');

// Ruta para mostrar el formulario de creación de una nueva ubicación
Route::get('ubicaciones/create', [UbicacionController::class, 'create'])->name('crear_ubicacion');

// Ruta para almacenar una nueva ubicación
Route::post('ubicaciones/store', [UbicacionController::class, 'store']);

// Ruta para mostrar los detalles de una ubicación
Route::get('ubicaciones/{ubicacion}', [UbicacionController::class, 'show'])->whereNumber('ubicacion')->name('detalles_ubicacion');

// Ruta para mostrar el formulario de edición de una ubicación
Route::get('ubicaciones/{ubicacion}/edit', [UbicacionController::class, 'edit'])->whereNumber('ubicacion')->name('editar_ubicacion');

// Ruta para actualizar una ubicación
Route::post('ubicaciones/{ubicacion}/update', [UbicacionController::class, 'update'])->whereNumber('ubicacion')->name('actualizar_ubicacion');

// Ruta para mostrar el formulario de confirmación de eliminación de una ubicación
Route::get('ubicaciones/{ubicacion}/destroyconfirm', [UbicacionController::class, 'destroyconfirm'])->whereNumber('ubicacion')->name('confirmar_borrar_ubicacion');

// Ruta para eliminar una ubicación
Route::post('ubicaciones/{ubicacion}/destroy', [UbicacionController::class, 'destroy'])->whereNumber('ubicacion')->name('borrar_ubicacion');

