<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Inertia\Inertia;

class TalleresController extends Controller
{
    /**
     * Muestra la lista de talleres.
     * @return \Inertia\Response
     */
    public function index()
    {
        $talleres = Taller::all();
        return Inertia::render('Taller/Listado', [
            'talleres' => $talleres,
        ]);
    }

    /**
     * Muestra los datos de un taller.
     * @param int $id Identificador del taller
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $taller = Taller::find($id);
        $ubicacion = $taller->ubicacion;
        return Inertia::render('Taller/Show', [
            'taller' => $taller,
            'ubicacion' => $ubicacion
        ]);
    }
}
