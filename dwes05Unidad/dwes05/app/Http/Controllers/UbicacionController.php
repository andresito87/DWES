<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UbicacionController extends Controller
{
    /**
     * Muestra la lista de ubicaciones.
     * @return \Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Devolvemos los datos paginados
        $ubicaciones = Ubicacion::paginate(3);
        if (count($ubicaciones) == 0) {
            return redirect()->route('ubicaciones')
                ->with('mensaje', 'No hay tantas ubicaciones para alcanzar esta página')
                ->with('tipo', 'informativo');
        }
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $validador = $this->validar($request);
        if ($validador->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validador);
        }

        $ubicacion = Ubicacion::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'dias' => implode(',', $request->input('dias'))
        ]);

        $ubicacion->save();

        return redirect()->route('ubicaciones')
            ->with('mensaje', 'Ubicación creada correctamente')
            ->with('tipo', 'exito');
    }

    /**
     * Muestra la ubicación especificada.
     * @param Ubicacion $ubicacion
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Ubicacion $ubicacion)
    {
        $ubicacion = Ubicacion::find($ubicacion->id);
        return view('ubicaciones.detalleubicacion', ['ubicacion' => $ubicacion]);
    }

    /**
     * Muestra el formulario para editar la ubicación especificada.
     * @param Ubicacion $ubicacion Ubicación a editar
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicaciones.editarubicacion', ['ubicacion' => $ubicacion]);
    }

    /**
     * Actualiza la ubicación especificada en la base de datos.
     * @param Request $request Datos del formulario
     * @param Ubicacion $ubicacion Ubicación a actualizar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        // Validamos los datos del formulario
        $validador = $this->validar($request);
        if ($validador->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validador);
        }

        $ubicacion = Ubicacion::find($ubicacion->id);
        $ubicacion->nombre = $request->input('nombre');
        $ubicacion->descripcion = $request->input('descripcion');
        $ubicacion->dias = implode(',', $request->input('dias'));

        // Verificamos que los talleres asociados a la ubicación tengan como dia, uno de los días del array de dias de la ubicación, sino no se puede editar la ubicación con esos dias y hay que mostar un mensaje de error
        foreach ($ubicacion->talleres as $taller) {
            if (!in_array($taller->dia_semana, $request->input('dias'))) {
                return redirect()->route('editar_ubicacion', ['ubicacion' => $ubicacion->id])
                    ->withInput()
                    ->withErrors([
                        'error' => 'No se puede seleccionar esos días, ya que hay talleres asociados a ella que no incluyen esos días. Más info consulte la lista de talleres ',
                        'linkTalleres' => 'aquí'
                    ])
                    ->with('tipo', 'error');
            }
        }

        $ubicacion->save();

        return redirect()->route('ubicaciones')
            ->with('mensaje', 'Ubicación actualizada correctamente')
            ->with('tipo', 'exito');
    }

    /**
     * Muestra el formulario de confirmación de eliminación de la ubicación especificada.
     * @param Ubicacion $ubicacion Ubicación a eliminar
     * @return \Illuminate\Contracts\View\View
     */
    public function destroyconfirm(Ubicacion $ubicacion)
    {
        return view('ubicaciones.confirmarborrarubicacion', ['ubicacion' => $ubicacion]);
    }

    /**
     * Elimina la ubicación especificada de la base de datos y los talleres 
     * asociados a ella.
     * @param Request $request Datos del formulario
     * @param Ubicacion $ubicacion Ubicación a eliminar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Ubicacion $ubicacion)
    {
        $haSidoEliminada = false;
        if ($request->input('confirmar') == 'si') {

            $ubicacion = Ubicacion::find($ubicacion->id);
            // No hace falta eliminar los talleres, ya que se eliminan en cascada
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

    private function validar(Request $request)
    {
        // Creamos un validador con las reglas de validación
        return Validator::make($request->all(), [
            'nombre' => 'required|min:4|max:50',
            'descripcion' => 'required',
            'dias' => 'required',
            'dias.*' => ['required', 'distinct', 'in:L,M,X,J,V,S,D']
        ]);
    }
}
