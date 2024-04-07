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
     * 
     * SWAGGER
     * Listado de todas las ubicaciones
     * @OA\Get (
     *     path="/api/ubicaciones",
     *     tags={"Ubicaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id",type="number",example="1"),
     *                     @OA\Property(property="nombre",type="string",example="Biblioteca Municipal Distrito 4"),
     *                     @OA\Property(property="descripcion",type="string",example="Biblioteca Municipal del distrito 4. 6ª Avenida"),
     *                     @OA\Property(property="dias",type="string",example="L,M,X"),
     *                     @OA\Property(property="created_at",type="string",example="2024-04-06 19:48:12"),
     *                     @OA\Property(property="updated_at",type="string",example="2024-04-06 19:48:12")
     *                 )
     *         )
     *     )
     * )
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
     * 
     * SWAGGER
     * Listado de todos los talleres de una ubicación
     * @OA\Get (
     *     path="/api/ubicaciones/{idUbicacion}/talleres",
     *     tags={"Ubicaciones"},
     *     @OA\Parameter(in="path",name="idUbicacion",required=true,@OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id",type="number",example="1"),
     *                     @OA\Property(property="ubicacion_id",type="number",example="1"),
     *                     @OA\Property(property="nombre",type="string",example="Taller de lectura"),
     *                     @OA\Property(property="descripcion", type="string", example="Taller de lectura en la biblioteca"),
     *                     @OA\Property(property="dia_semana", type="string", example="L"),
     *                     @OA\Property(property="hora_inicio", type="string", example="10:00:00"),
     *                     @OA\Property(property="hora_fin", type="string", example="11:00:00"),
     *                     @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *              )
     *          
     *        )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Ubicación no existente"),
     *          )
     *      )
     * )
     */
    public function talleres(int|string $idUbicacion)
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
