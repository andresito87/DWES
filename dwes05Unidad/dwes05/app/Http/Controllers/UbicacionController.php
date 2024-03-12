<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class UbicacionController extends Controller
{
    /**
     * Muestra la lista de ubicaciones.
     */
    public function index()
    {
        // Devolvemos los datos paginados
        $ubicaciones = Ubicacion::paginate(3);
        return view('ubicaciones', ['ubicaciones' => $ubicaciones]);
    }

    /**
     * Muestra el formulario para crear una nueva ubicación.
     */
    public function create()
    {
        return view('crear_ubicacion');
    }

    /**
     * Almacena una nueva ubicación en la base de datos.
     * @param Request $request Datos del formulario
     */
    public function store(Request $request)
    {
        try {
            $datosvalidados = $request->validate([
                'nombre' => ['required', 'min:4', 'max:50'],
                'descripcion' => 'required',
                'dias' => ['required', 'array'],
                'dias.*' => ['required', 'distinct', 'in:L,M,X,J,V,S,D']
            ]);
        } catch (ValidationException $e) {
            return Redirect::back()
                ->withInput()
                ->withErrors($e->errors());
        }

        $ubicacion = new Ubicacion();
        $ubicacion->nombre = $datosvalidados['nombre'];
        $ubicacion->descripcion = $datosvalidados['descripcion'];
        $ubicacion->dias = implode(',', $datosvalidados['dias']);

        $ubicacion->save();

        return redirect()->route('ubicaciones')
            ->with('mensaje', 'Ubicación creada correctamente')
            ->with('tipo', 'exito');
    }

    /**
     * Muestra la ubicación especificada.
     * @param Ubicacion $ubicacion
     */
    public function show(Ubicacion $ubicacion)
    {
        $ubicacion = Ubicacion::find($ubicacion->id);
        return view('ubicaciones.detalleubicacion', ['ubicacion' => $ubicacion]);
    }

    /**
     * Muestra el formulario para editar la ubicación especificada.
     * @param Ubicacion $ubicacion Ubicación a editar
     */
    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicaciones.editarubicacion', ['ubicacion' => $ubicacion]);
    }

    /**
     * Actualiza la ubicación especificada en la base de datos.
     * @param Request $request Datos del formulario
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        try {
            $datosvalidados = $request->validate([
                'nombre' => 'required|min:4|max:50',
                'descripcion' => 'required',
                'dias' => 'required',
                'dias.*' => ['required', 'distinct', 'in:L,M,X,J,V,S,D']
            ]);
        } catch (ValidationException $e) {
            return Redirect::back()
                ->withInput()
                ->withErrors($e->errors());
        }

        $ubicacion = Ubicacion::find($ubicacion->id);
        $ubicacion->nombre = $datosvalidados['nombre'];
        $ubicacion->descripcion = $datosvalidados['descripcion'];
        $ubicacion->dias = implode(',', $datosvalidados['dias']);

        $ubicacion->save();

        return redirect()->route('ubicaciones')
            ->with('mensaje', 'Ubicación actualizada correctamente')
            ->with('tipo', 'exito');
    }

    /**
     * Muestra el formulario de confirmación de eliminación de la ubicación especificada.
     * @param Ubicacion $ubicacion Ubicación a eliminar
     */
    public function destroyconfirm(Ubicacion $ubicacion)
    {
        return view('ubicaciones.confirmarborrarubicacion', ['ubicacion' => $ubicacion]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ubicacion $ubicacion)
    {
        $haSidoEliminada = false;
        if ($request->input('confirmar') == 'si') {

            $ubicacion = Ubicacion::find($ubicacion->id);
            /*foreach ($ubicacion->talleres as $taller) {
                Taller::destroy($taller->id);
            }*/
            if (Ubicacion::destroy($ubicacion->id) > 0) {
                $haSidoEliminada = true;
            }
        }

        return redirect()->route('ubicaciones')
            ->with('mensaje', $haSidoEliminada ? 'Ubicación eliminada correctamente' : 'No se ha eliminado la ubicación')
            ->with('tipo', $haSidoEliminada ? 'exito' : 'informativo');
    }
}
