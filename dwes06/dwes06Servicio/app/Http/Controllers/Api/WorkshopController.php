<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Http\Resources\WorkshopResource;
use App\Models\Taller;
use App\Models\Ubicacion;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WorkshopResource::collection(
            Taller::query()->orderBy('id', 'desc')->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkshopRequest $request)
    {
        $data = $request->validated();
        $ubicacion = Ubicacion::find($data['ubicacion_id']);
        if (! $ubicacion) {
            return response()->json(['message' => 'Ubicación no encontrada'], 404);
        }

        $dias_disponibles = explode(',', $ubicacion->dias);
        if (! in_array($data['dia_semana'], $dias_disponibles)) {
            return response()->json(['message' => 'Día no disponible en la ubicación'], 422);
        }

        $workshop = Taller::create($data);
        return response()->json(new WorkshopResource($workshop), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $idTaller)
    {
        if (! Taller::where('id', $idTaller)->exists()) {
            return response()->json(['message' => 'Taller no encontrado'], 404);
        }
        return new WorkshopResource(Taller::findOrFail($idTaller));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkshopRequest $request, Taller $workshop)
    {
        $data = $request->validated();
        $ubicacion = Ubicacion::find($data['ubicacion_id']);
        $dias_disponibles = explode(',', $ubicacion->dias);
        if (! in_array($data['dia_semana'], $dias_disponibles)) {
            return response()->json(['message' => 'Día no disponible en la ubicación'], 422);
        }
        $workshop->update($data);
        return new WorkshopResource($workshop);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Taller $workshop)
    {
        $workshop->delete();
        return response()->json("", 204);
    }
}
