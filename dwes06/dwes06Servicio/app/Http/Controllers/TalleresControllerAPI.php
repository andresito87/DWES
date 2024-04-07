<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class TalleresControllerAPI
 * Controlador para gestionar los talleres de la aplicación.
 * @package App\Http\Controllers
 * 
 * SWAGGER
 * @OA\Info(title="API de Talleres y Ubicaciones",version="1.0",description="Listado de URI's de la API de Talleres y Ubicaciones")
 * @OA\Server(url="http://127.0.0.1:8000/")
 */
class TalleresControllerAPI extends Controller
{
    /**
     * Almacena un taller en la base de datos.
     * @param int|string $idubicacion Ubicacion a la que se va añadir el taller
     * @annotation Decido dar un tipado de int|string al parámetro para evitar un código de estado 500 
     * cuando se procesa un idubicacion que es un string o que no puede ser transformable a entero
     * @param Request $request petición con los datos del taller introducidos en el formulario
     * @return \Illuminate\Http\JsonResponse
     * 
     * SWAGGER
     * Permite crear un taller en una ubicación concreta.
     * @OA\Post (
     *     path="/api/ubicaciones/{idUbicacion}/creartaller",
     *     tags={"Talleres"},
     *    @OA\Parameter(in="path",name="idUbicacion",required=true,@OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *            @OA\Property(property="resultado", type="string", example="ok"),
     *             @OA\Property(
     *                 property="datos",
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
     *                  )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="La ubicación no existe"),
     *          )
     *      )
     * )
     */
    public function store(int|string $idubicacion, Request $request)
    {
        // Verificar si $idubicacion es un entero o una cadena que representa un entero positivo
        if (! is_int($idubicacion) && ! ctype_digit($idubicacion)) {
            return response()->json(['error' => 'Debe indicar un entero como ubicación.'], 404);
        }

        $ubicacion = Ubicacion::find($idubicacion);
        if ($ubicacion == null) {
            return response()->json(['error' => 'La ubicación no existe'], 404);
        }

        // Obtener los datos del taller
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $diaSemana = $request->input('dia_semana');
        $horaInicio = $request->input('hora_inicio');
        $horaFin = $request->input('hora_fin');
        $cupoMaximo = $request->input('cupo_maximo');
        $diasDisponibles = Ubicacion::find($idubicacion)->dias;

        // Array que contiene todos los mensajes que usará el validador para informar de fallos de validacion
        $mensajesPersonalizados = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            'dia_semana.required' => 'El día de la semana es obligatorio.',
            'dia_semana.string' => 'El día de la semana debe ser una cadena de caracteres.',
            'dia_semana.in' => 'La ubicación no está disponible el día indicado.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'La hora de inicio debe estar en formato 00:00(24 horas).',
            'hora_fin.required' => 'La hora de fin es obligatoria.',
            'hora_fin.date_format' => 'La hora de fin debe estar en formato 00:00(24 horas).',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'cupo_maximo.required' => 'El cupo máximo es obligatorio.',
            'cupo_maximo.integer' => 'El cupo máximo debe ser un número entero.',
            'cupo_maximo.min' => 'El cupo máximo debe ser como mínimo :min.',
            'cupo_maximo.max' => 'El cupo máximo no puede ser mayor a :max.',
        ];


        // Validar los datos del taller
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'dia_semana' => 'required|string|in:' . $diasDisponibles,
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'cupo_maximo' => 'required|integer|min:5|max:30'], $mensajesPersonalizados);

        // Si el validador encuentra errores, retornamos un json con estos fallos, codigo de estado 422
        if ($validator->fails()) {
            return response()->json(['errores' => $validator->errors()], 422);
        }

        // Creamos el taller
        $taller = new Taller();
        $taller->nombre = $nombre;
        $taller->descripcion = $descripcion;
        $taller->dia_Semana = $diaSemana;
        $taller->ubicacion_id = $idubicacion;
        $taller->hora_inicio = $horaInicio;
        $taller->hora_fin = $horaFin;
        $taller->cupo_maximo = $cupoMaximo;
        $taller->save();

        // Recuperar el taller recién guardado
        $tallerGuardado = Taller::find($taller->id);

        // Retornar una respuesta exitosa, codigo de estado 200 y los datos del taller guardado
        return response()->json(['resultado' => 'ok', 'datos' => $tallerGuardado], 200);
    }

    /**
     * Elimina un taller con un determinado id de la base de datos.
     * @param int|string $id Id del taller a eliminar
     * @annotation Decido tipar con int|string para evitar que cuando el usuario teclee un id que no es un entero, el servidor 
     * responda con un código 500. De esta forma, es el controlador quien gestiona esa casuística.
     * @return \Illuminate\Http\JsonResponse
     * 
     * SWAGGER
     * Permite eliminar un taller de la base de datos
     * @OA\Delete (
     *     path="/api/talleres/{idTaller}",
     *     tags={"Talleres"},
     *     @OA\Parameter(in="path",name="idTaller",required=true,@OA\Schema(type="integer")),
     *     @OA\Response(response=200,description="OK",
     *         @OA\JsonContent(@OA\Property(property="resultado", type="string", example="eliminado"))),
     *      @OA\Response(response=404,description="NOT FOUND",
     *          @OA\JsonContent(@OA\Property(property="resultado", type="string", example="No existe")))
     *      )
     */
    public function destroy(int|string $id)
    {
        // Verificar si $id del taller es un entero o una cadena que representa un entero positivo
        if (! is_int($id) && ! ctype_digit($id)) {
            return response()->json(['resultado' => 'Debe indicar un entero como id del taller.'], 404);
        }

        $taller = Taller::find($id);
        if (! $taller) {
            return response()->json(['resultado' => 'No existe'], 404);
        }
        $taller->delete();
        return response()->json(['resultado' => 'eliminado'], 200);
    }

    /**
     * Cambia la ubicación de un taller.
     * @param int $idtaller Id del taller a cambiar de ubicación
     * @param Request $request Petición con los datos de la nueva ubicación
     * @return \Illuminate\Http\JsonResponse
     */
    public function cambiarUbicacion(int|string $idtaller, Request $request)
    {
        // Verificar si la petición contiene datos JSON
        if (! $request->isJson()) {
            return response()->json(['error' => 'Datos no procesables (se espera JSON)'], 422);
        }
        $datos = $request->json()->all();

        // Verificar si el JSON contiene la clave 'nueva_ubicacion'
        if (! isset($datos['nueva_ubicacion'])) {
            return response()->json(['error' => 'Datos no procesables (JSON no contiene los datos esperados)'], 422);
        }
        $idUbicacion = $datos['nueva_ubicacion'];

        // Verificar si $idtaller es un entero o una cadena que representa un entero positivo
        if (! is_int($idtaller) && ! ctype_digit($idtaller)) {
            return response()->json(['error' => 'Debe indicar un entero como id del taller.'], 404);
        }

        // Verificar si $idUbicacion es un entero o una cadena que representa un entero positivo
        if (! is_int($idUbicacion) && ! ctype_digit($idUbicacion)) {
            return response()->json(['error' => 'Debe indicar un entero como id de la nueva ubicación.'], 404);
        }

        $taller = Taller::find($idtaller);
        if ($taller == null) {
            return response()->json(['error' => 'Taller no encontrado'], 404);
        }

        // Verificar si la nueva ubicación existe
        $ubicacion = Ubicacion::find($idUbicacion);
        if ($ubicacion == null) {
            return response()->json(['error' => 'Ubicación no válida o no existente'], 422);
        }

        // Verificar si la nueva ubicación tiene el día de la semana del taller
        $diasDisponibles = Ubicacion::find($idUbicacion)->dias;
        $arrayDiasDisponibles = explode(',', $diasDisponibles);
        if (! in_array($taller->dia_semana, $arrayDiasDisponibles)) {
            return response()->json(['error' => 'La ubicación no está disponible el día del taller'], 409);
        }

        $taller->ubicacion_id = $idUbicacion;
        $taller->save();

        return response()->json(['resultado' => 'Operación realizada correctamente', 'datos' => $taller], 200);
    }
}
