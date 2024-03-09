<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pintor;
use App\Models\Pintura;

class Relacion1NController extends Controller
{
    public function read()
    {
        $pintor = Pintor::whereNombre('Diego Velázquez')->first();

        foreach ($pintor->pinturas as $pintura) {
            echo $pintura->título . '<br />';
            echo $pintura->descripción . '<br /><br />';
        }
    }

    public function display()
    {
        $pintura = Pintura::whereTítulo('Las meninas')->first();

        echo $pintura->pintor->id . '<br />';
        echo $pintura->pintor->nombre . '<br />';
        echo $pintura->pintor->bio . '<br />';
    }
}