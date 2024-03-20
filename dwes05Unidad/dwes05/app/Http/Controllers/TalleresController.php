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
     * @return \Inertia\Response | \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $taller = Taller::find($id);
        if (!$taller) {
            return Inertia::render('404NotFound');
        }
        $ubicacion = $taller->ubicacion;
        return Inertia::render('Taller/Show', [
            'taller' => $taller,
            'ubicacion' => $ubicacion
        ]);
    }
}
