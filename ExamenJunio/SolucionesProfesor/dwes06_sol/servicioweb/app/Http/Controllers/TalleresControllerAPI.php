<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TalleresControllerAPI extends Controller
{
    /**
    * Store a newly created resource in storage.
    */
    public function store(int $idubicacion, Request $request)
    {
        $ubicacion=Ubicacion::find($idubicacion);

        if (!$ubicacion)
            return response()->json(['error'=>'Ubicación no existe.'],404);

        $validador=Validator::make($request->all(),
        [
            'nombre'=>'required|string|max:50',
            'descripcion'=>'string',
            'dia_semana'=>'required|string|in:'.$ubicacion->dias,
            'hora_inicio'=>'required|date_format:H:i',
            'hora_fin'=>'required|date_format:H:i|after:hora_inicio',
            'cupo_maximo'=>'required|integer|between:5,30'
        ],[
            'nombre.required'=>'Campo obligatorio no indicado.',
            'dia_semana.required'=>'Campo obligatorio no indicado.',
            'hora_inicio.required'=>'Campo obligatorio no indicado.',
            'hora_fin.required'=>'Campo obligatorio no indicado.',
            'cupo_maximo.required'=>'Campo obligatorio no indicado.',
            'dia_semana.in'=>'La ubicación no está disponible el dia indicado.',
            'hora_inicio.date_format'=>'La hora de inicio no tiene el formato esperado',
            'hora_fin.date_format'=>'La hora de fin no tiene el formato esperado',
            'hora_fin.after'=>'La hora de fin es posterior a la hora de inicio',
            'cupo_maximo.between'=>'El cupo máximo no está entre 5 y 30',
            'cupo_maximo.integer'=>'El cupo máximo no es un entero'
        ]);

        if ($validador->fails())
        {
            return response()->json(['errores'=>$validador->errors()],422);
        }

        $datos=$validador->validate();
        $datos['ubicacion_id']=$ubicacion->id;
        $taller=Taller::create($datos);

        return response()->json(['resultado'=>'ok','datos'=>$taller]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $taller=Taller::find($id);
        if ($taller)
        {
            $taller->delete();
            return ['resultado'=>'eliminado'];
        }
        else
        {
            return response()->json(['resultado'=>'noexiste'],404);
        }
    }

    public function cambiarUbicacion(int $idtaller, Request $request)
    {
        $taller=Taller::find($idtaller);
        if (!$taller)
        {
            return response()->json(['error'=>'Taller no encontrado'],404);
        }
        if ($request->isJson())
        {
            $datos=$request->json()->all();
            if (isset($datos['nueva_ubicacion']) && is_numeric($datos['nueva_ubicacion']))
            {
                $ubicacion=Ubicacion::find($datos['nueva_ubicacion']);
                if (!$ubicacion)
                    return response()->json(['error'=>'Ubicacion no válida o no existente'],422);
            }
            else
                return response()->json(['error'=>'Datos no procesables (JSON no contiene los datos esperados)'],422);
        }
        else
        {
            return response()->json(['error'=>'Datos no procesables (se espera JSON)'],422);
        }
        if (!in_array($taller->dia_semana,explode(',',$ubicacion->dias)))
        {
            return response()->json(['error'=>'La ubicación no está disponible el día del taller.'],409);
        }

        $taller->ubicacion_id=$ubicacion->id;
        $taller->save();
        return ['resultado'=>'Operación realizada'];
    }
}
