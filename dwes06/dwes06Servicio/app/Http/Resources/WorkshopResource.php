<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
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
        $ubicacion_id = $this->ubicacion_id;
        return [
            'id' => $this->id,
            'ubicacion_id' => $ubicacion_id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'dia_semana' => $this->dia_semana,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'cupo_maximo' => $this->cupo_maximo,
        ];
    }
}
