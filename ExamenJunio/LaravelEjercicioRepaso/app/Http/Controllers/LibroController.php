<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Validation\ValidationException;

class LibroController extends Controller
{
    public function mostrarFormNuevoLibro()
    {
        return view('libro.nuevo');
    }

    public function crearNuevoLibro(Request $request)
    {
        // Validamos los datos con validación de Laravel
        try {
            $request->validate([
                'titulo' => 'required|string|max:255',
                'year' => 'required|integer|min:0|max:2024',
                'autor' => 'required|string|max:255',
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('formNuevoLibro')->withInput()->withErrors($e->validator);
        }

        $libro = new Libro();
        $libro->titulo = $request->input('titulo');
        $libro->year = $request->input('year');
        $libro->autor = $request->input('autor');

        $libro->save();

        // Devolvemos un mensaje de éxito en formato JSON
        return response()->json(['message' => 'Libro creado correctamente']);
        // Otra opción sería redirigir a la vista de listado de libros
        //return redirect()->route('mostrarLibros');
    }

    public function listarLibrosEntreDosYears(Request $request)
    {
        // Validamos los datos con validación de Laravel
        try {
            $request->validate([
                'maxYear' => 'integer|max:2024',
                'minYear' => 'integer|max:2024',
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('mostrarLibros')->withInput()->withErrors($e->validator);
        }

        //$libros = Libro::whereBetween('year', [$request->input('minYear'), $request->input('maxYear')])->get();


        // es lo mismo que hacer
        $libros = Libro::where('year', '>=', $request->input('minYear') ?? 0)
            ->where('year', '<=', $request->input('maxYear') ?? 2024)
            ->get();

        // get(); devuelve un array de objetos, si no hay resultados, devuelve un array vacío
        // first(); devuelve un único objeto, si no hay resultados, devuelve null

        return view('libro.listado', ['libros' => $libros]); // usando get() en lugar de first() necesitamos pasar un array de objetos

    }
}
