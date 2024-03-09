<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pintor;
use App\Models\Pintura;

class PinturaController extends Controller
{
    public function add()
    {
        $pintor = Pintor::find(2);

        $pintura = new Pintura;

        $pintura->título = 'Las meninas';
        $pintura->descripción = 'Muy popular y de grandes dimensiones';
        $pintura->pintor_id = $pintor->id;

        $pintura->save();


        $pintura = new Pintura;

        $pintura->título = 'Vieja friendo huevos';
        $pintura->descripción = 'Pintado en Sevilla en 1618.';
        $pintura->pintor_id = $pintor->id;

        $pintura->save();
    }

    public function present()
    {
        $pinturas = Pintura::all();

        return $pinturas;
    }
}