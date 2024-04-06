<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TalleresControllerAPI extends Controller
{
    /**
     * Almacena un taller en la base de datos.
     * @param int|string idubicacion Ubicacion a la que se va añadir el taller
     * @annotation Decido dar un tipado de int|string al parámetro para evitar un código de estado 500 
     * cuando se procesa un idubicacion que es un string o que no puede ser transformable a entero
     * @param Request request petición con los datos del taller introducidos en el formulario
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
     */
    public function destroy(int|string $id)
    {
        // Verificar si $id del taller es un entero o una cadena que representa un entero positivo
        if (! is_int($id) && ! ctype_digit($id)) {
            return response()->json(['error' => 'Debe indicar un entero como id del taller.'], 404);
        }

        $taller = Taller::find($id);
        if (! $taller) {
            return response()->json(['resultado' => 'No existe'], 404);
        }
        $taller->delete();
        return response()->json(['resultado' => 'eliminado'], 200);
    }
}
