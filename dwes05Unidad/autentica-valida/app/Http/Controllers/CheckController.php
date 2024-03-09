<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CheckController extends Controller
{
    public function formulario()
    {
        return view('insertar-dato');
    }

    public function confirmar(Request $request)
    {
        try {
            $validated = $request->validate([
                'dato' => 'required|integer|digits_between:1,10'
            ]);
            if ($validated) {
                return response('El dato es válido.', 200);
            }
        } catch (ValidationException $e) {
            return response('El dato no es válido.', 400);
        }
    }
}