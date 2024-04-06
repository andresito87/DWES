<?php

use App\Http\Controllers\TalleresControllerAPI;
use App\Http\Controllers\UbicacionesControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('ubicaciones', [UbicacionesControllerAPI::class, 'listar'])->name('listadoUbicaciones');

Route::get('/ubicaciones/{idubicacion}/talleres', [UbicacionesControllerAPI::class, 'talleres'])->name('listadoTalleresEnUbicacion');

Route::post('/ubicaciones/{idubicacion}/creartaller', [TalleresControllerAPI::class, 'store'])->name('crearTaller');

Route::delete('/talleres/{idtaller}', [TalleresControllerAPI::class, 'destroy'])->name('eliminarTaller');

