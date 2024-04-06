<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Ubicacion;

/**
 * Class UbicacionesControllerAPI
 * Controlador para gestionar las ubicaciones de la aplicación.
 * @package App\Http\Controllers
 */
class UbicacionesControllerAPI extends Controller
{
    /**
     * Devuelve un listado con todas las ubicaciones.
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar()
    {
        $ubicaciones = Ubicacion::all();
        return response()->json($ubicaciones);
    }

    /**
     * Devuelve un listado con los talleres de una ubicación.
     * @param int $idUbicacion Identificador de la ubicación
     * @annotation Decido dar un tipado de int|string al parámetro para evitar un código de estado 500
     * @return \Illuminate\Http\JsonResponse
     */
    public function talleres(int $idUbicacion)
    {
        // Verificar si $idUbicacion es un entero o una cadena que representa un entero positivo
        if (! is_int($idUbicacion) && ! ctype_digit($idUbicacion)) {
            return response()->json(['error' => 'Debe indicar un entero como ubicación.'], 404);
        }
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
