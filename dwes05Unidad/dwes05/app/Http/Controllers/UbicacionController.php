<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UbicacionController extends Controller
{
    /**
     * Muestra la lista de ubicaciones.
     */
    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return view('ubicaciones', ['ubicaciones' => $ubicaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crear_ubicacion');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $datosvalidados = $request->validate([
                'nombre' => 'required|min:4|max:50',
                'descripcion' => 'required',
                'dias' => ['required', 'array'],
                'dias.*' => ['required', 'distinct', 'in:L,M,X,J,V,S,D']
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('crear_ubicacion')
                ->with('errors', $e->validator->errors());
        }

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = $datosvalidados['nombre'];
        $ubicacion->descripcion = $datosvalidados['descripcion'];
        $ubicacion->dias = implode(',', $datosvalidados['dias']);

        $ubicacion->save();

        return redirect()->route('index')
            ->with('mensaje', 'Ubicación creada correctamente')
            ->with('tipomensaje', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}
