<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TalleresController extends Controller
{
    public function index()
    {
        $talleres = Taller::all();
        return Inertia::render('Taller/Show', [
            'talleres' => $talleres,
        ]);
    }
}
