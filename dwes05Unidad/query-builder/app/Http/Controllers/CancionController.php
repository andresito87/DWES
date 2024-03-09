<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CancionController extends Controller
{
    public function portada()
    {
        return view('inicio');
    }

    public function composiciones()
    {
        $datos = DB::table('canciones')->get();

        return view('piezas-musicales', ['canciones' => $datos]);
    }

    public function crear()
    {
        return view('insertar');
    }

    public function almacenar(Request $request)
    {
        DB::table('canciones')->insert([
            'titulo' => $request->input('title'),
            'artista' => $request->input('artist'),
            'lanzamiento' => $request->input('launch'),
            'genero' => $request->input('genre'),
            'duracion' => $request->input('duration'),
        ]);

        return redirect()->route('obras-musicales');
    }
}