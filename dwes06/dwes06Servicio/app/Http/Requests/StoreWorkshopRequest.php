<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkshopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'nombre' => 'required|string|min:4|max:50',
            'descripcion' => 'required|string|max:255',
            'dia_semana' => ['required', 'string', 'regex:/^[LMXJVSD]$/'],
            'hora_inicio' => 'required', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/',
            'hora_fin' => 'required', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', 'after:hora_inicio',
            'cupo_maximo' => 'required|integer|min:1|max:30',
        ];
    }
}
