<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    public function search(Request $request) : View
    {
        $videojuegos = Videojuego::all()->toArray();
        try {
            $validated = $request->validate([
                'nombre' => 'string|nullable',
                'anyo_lanzamiento' => 'integer|nullable'
            ]);

            $nombre = $validated['nombre'];
            $anyo_lanzamiento = $validated['anyo_lanzamiento'];

            $videojuegos = array_filter($videojuegos, function ($videojuego) use ($nombre, $anyo_lanzamiento) {
                return (empty ($nombre) || stripos($videojuego['nombre'], $nombre) !== false) && (empty ($anyo_lanzamiento) || $videojuego['anyo_lanzamiento'] == $anyo_lanzamiento);
            });

            //return view('filtrado')->with('videojuegos', $videojuegos); es lo mismo que la línea de abajo
            return view('filtrado', ['videojuegos' => $videojuegos]);
        } catch (\Exception $e) {
            return view('error');
        }
    }

    public function showForm() : View
    {
        return view('filtrar');
    }
}
