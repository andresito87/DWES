<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUbicationRequest extends FormRequest
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
            'nombre' => 'required|string|min:4|max:50',
            'descripcion' => 'required|string|max:255',
            'dias' => ['required', 'string', 'regex:/^([LMXJVSD],)*[LMXJVSD]$/'],
        ];
    }
}
