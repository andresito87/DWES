<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UbicacionesControllerAPI;
use App\Http\Controllers\TalleresControllerAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ubicaciones',[UbicacionesControllerAPI::class,'listar']);

Route::get('/ubicaciones/{idubicacion}/talleres',[UbicacionesControllerAPI::class,'talleres'])
        ->whereNumber('idubicacion');


Route::post('/ubicaciones/{idubicacion}/creartaller',
        [TalleresControllerAPI::class,'store'])
        ->whereNumber('idubicacion');

Route::delete('/talleres/{id}',[TalleresControllerAPI::class,'destroy'])->whereNumber('id');

Route::patch('/talleres/{id}/cambiarubicacion',[TalleresControllerAPI::class,'cambiarUbicacion'])->whereNumber('id');
