<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Ubicacion;

class UbicacionesControllerAPI extends Controller
{
    public function listar()
    {
        $ubicaciones = Ubicacion::all();
        return response()->json($ubicaciones);
    }

    public function talleres(int $idUbicacion)
    {
        $ubicacion = Ubicacion::find($idUbicacion);
        if ($ubicacion == null) {
            return response()->json(['error' => 'Ubicación no existente'], 404);
        }
        $talleres = Taller::where('ubicacion_id', $idUbicacion)->get();
        if ($talleres->count() == 0) {
            return response()->json([], 200);
        } else {
            return response()->json($talleres, 200);
        }
    }
}