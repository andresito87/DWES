<?php

use App\Http\Controllers\TalleresController;
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
Route::get('ubicaciones', [UbicacionController::class, 'index'])->name('ubicaciones');

// Ruta para mostrar el formulario de creación de una nueva ubicación
Route::get('ubicaciones/create', [UbicacionController::class, 'create'])->name('crear_ubicacion');

// Ruta para almacenar una nueva ubicación
Route::post('ubicaciones/store', [UbicacionController::class, 'store'])->name('almacenar_ubicacion_BD');

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

// Ruta para mostrar la lista de talleres
Route::get('/talleres', [TalleresController::class, 'index'])->name('talleres');

// Ruta para mostrar los detalles de un taller
Route::get('/talleres/{taller}', [TalleresController::class, 'show'])->whereNumber('taller')->name('detalles_taller');

/* Si uso el agrupamiento de rutas, no me funcionan los tests de regresión con Dusk
Route::controller(UbicacionController::class)->group(
    function () {
        // Ruta para mostrar la lista de ubicaciones
        Route::get('ubicaciones', 'index')->name('ubicaciones');
        // Ruta para mostrar el formulario de creación de una nueva ubicación
        Route::get('ubicaciones/create', 'create')->name('crear_ubicacion');
        // Ruta para almacenar una nueva ubicación
        Route::post('ubicaciones/store', 'store')->name('almacenar_ubicacion_BD');
        // Ruta para mostrar los detalles de una ubicación
        Route::get('ubicaciones/{ubicacion}', 'show')->whereNumber('ubicacion')->name('detalles_ubicacion');
        // Ruta para mostrar el formulario de edición de una ubicación
        Route::get('ubicaciones/{ubicacion}/edit', 'edit')->whereNumber('ubicacion')->name('editar_ubicacion');
        // Ruta para actualizar una ubicación
        Route::post('ubicaciones/{ubicacion}/update', 'update')->whereNumber('ubicacion')->name('actualizar_ubicacion');
        // Ruta para mostrar el formulario de confirmación de eliminación de una ubicación
        Route::get('ubicaciones/{ubicacion}/destroyconfirm', 'destroyconfirm')->whereNumber('ubicacion')->name('confirmar_borrar_ubicacion');
        // Ruta para eliminar una ubicación
        Route::post('ubicaciones/{ubicacion}/destroy', 'destroy')->whereNumber('ubicacion')->name('borrar_ubicacion');
    }
);

Route::controller(TalleresController::class)->group(
    function () {
        // Ruta para mostrar la lista de talleres
        Route::get('talleres', 'index')->name('talleres');
        // Ruta para mostrar los detalles de un taller
        Route::get('talleres/{taller}', 'show')->whereNumber('taller')->name('detalles_taller');
    }
);
*/


