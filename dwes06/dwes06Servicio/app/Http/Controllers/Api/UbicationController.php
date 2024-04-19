<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ubicacion;
use App\Http\Requests\StoreUbicationRequest;
use App\Http\Requests\UpdateUbicationRequest;
use App\Http\Resources\UbicationResource;

class UbicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UbicationResource::collection(
            Ubicacion::query()->orderBy('id', 'desc')->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUbicationRequest $request)
    {
        $data = $request->validated();
        $ubication = Ubicacion::create($data);
        return response()->json(new UbicationResource($ubication), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $idUbicacion)
    {
        if (! Ubicacion::where('id', $idUbicacion)->exists()) {
            return response()->json(['message' => 'Ubicación no encontrada'], 404);
        }
        return new UbicationResource(Ubicacion::findOrFail($idUbicacion));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUbicationRequest $request, Ubicacion $ubication)
    {
        $data = $request->validated();
        $ubication->update($data);
        return new UbicationResource($ubication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $ubication)
    {
        $ubicacion = Ubicacion::find($ubication);
        if (! $ubicacion) {
            return response()->json(['message' => 'Ubicación no encontrada'], 404);
        }

        if ($ubicacion->delete()) {
            return response()->json('', 204);
        }

        return response()->json(['message' => 'No se pudo eliminar la ubicación'], 500);
    }
}
