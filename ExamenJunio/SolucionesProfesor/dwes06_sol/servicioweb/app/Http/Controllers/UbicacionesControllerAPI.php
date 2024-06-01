<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;
use stdClass;

class UbicacionesControllerAPI extends Controller
{
    public function listar()
    {
        $arrayUbicaciones=[];
        $ubicaciones=Ubicacion::all();
        foreach($ubicaciones as $ubicacion)
        {
            $u=new stdClass;
            $u->id=$ubicacion->id;
            $u->nombre=$ubicacion->nombre;
            $u->descripcion=$ubicacion->descripcion;
            $u->dias=explode(',',$ubicacion->dias);
            $arrayUbicaciones[]=$u;
        }
        return response()->json($arrayUbicaciones);
    }

    public function talleres(int $idubicacion)
    {
        $ubicacion=Ubicacion::find($idubicacion);
        if (!$ubicacion)
            return response()->json(['error'=>'Ubicación no existente'],404);

        $talleres=[];
        foreach($ubicacion->talleres as $taller)
        {
            $ntaller=new stdClass;
            $ntaller->id=$taller->id;
            $ntaller->nombre=$taller->nombre;
            $ntaller->descripcion=$taller->descripcion;
            $ntaller->dia_semana=$taller->dia_semana;
            $ntaller->hora_inicio=$taller->hora_inicio;
            $ntaller->hora_fin=$taller->hora_fin;
            $ntaller->cupo_maximo=$taller->cupo_maximo;
            $talleres[]=$ntaller;
        };
        return $talleres;
    }
}
