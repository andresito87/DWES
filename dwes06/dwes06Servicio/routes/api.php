<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UbicationController;
use App\Http\Controllers\TalleresControllerAPI;
use App\Http\Controllers\UbicacionesControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/* Rutas de Talleres y Ubicaciones */
Route::get('ubicaciones', [UbicacionesControllerAPI::class, 'listar'])->name('listadoUbicaciones');

Route::get('/ubicaciones/{idubicacion}/talleres', [UbicacionesControllerAPI::class, 'talleres'])->name('listadoTalleresEnUbicacion');

Route::post('/ubicaciones/{idubicacion}/creartaller', [TalleresControllerAPI::class, 'store'])->name('crearTaller');

Route::delete('/talleres/{idtaller}', [TalleresControllerAPI::class, 'destroy'])->name('eliminarTaller');

Route::patch('/talleres/{idtaller}/cambiarubicacion', [TalleresControllerAPI::class, 'cambiarUbicacion'])->name('cambiarUbicacion');

/* Rutas con Autenticación */
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Obtenemos el usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Desconexión del usuario autenticado
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // CRUD para todos los usuarios
    Route::apiResource('/users', UserController::class);
    // CRUD para todas las ubicaciones
    Route::apiResource('/ubications', UbicationController::class);
});


/* Rutas de Autenticación y Registro */
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

