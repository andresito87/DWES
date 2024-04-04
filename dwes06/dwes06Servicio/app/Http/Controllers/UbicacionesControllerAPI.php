<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionesControllerAPI extends Controller
{
    public function listar()
    {
        $ubicaciones = Ubicacion::all();
        return response()->json($ubicaciones);
    }
}
