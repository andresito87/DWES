<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UbicationResource extends JsonResource
{
    /**
     * Indicate if the resource should be wrapped within object.
     * Example: { "data": [ ... ] }
     * Userful when returning a collection of resources in axios.
     *
     * @var bool
     */
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        $talleres = $this->talleres;
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'dias' => $this->dias,
            'talleres' => $talleres->count() > 0 ? $talleres : 'No hay talleres en esta ubicación.',
        ];
    }
}
