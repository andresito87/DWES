<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pintor;

class PintorController extends Controller
{
    public function store()
    {
        $pintor = new Pintor;
        $pintor->nombre = 'Leonardo Da Vinci';
        $pintor->bio = 'Pintor renacentista, ingeniero, inventor, etc.';
        $pintor->save();

        $pintor = new Pintor;
        $pintor->nombre = 'Diego Velázquez';
        $pintor->bio = 'Pintor barroco español y maestro universal.';
        $pintor->save();

        $pintor = new Pintor;
        $pintor->nombre = 'Rembrandt';
        $pintor->bio = 'Pintor muy admirado por su vívido realismo.';
        $pintor->save();

        $pintor = new Pintor;
        $pintor->nombre = 'Francisco de Goya';
        $pintor->bio = 'Pintor español precursor del expresionismo.';
        $pintor->save();

        return 'Cuatro pintores insertados en la base de datos.';
    }

    public function index()
    {
        $pintores = Pintor::all();

        return $pintores;
    }

    public function show(string $id)
    {
        $pintor = Pintor::find($id);

        return $pintor;
    }

    public function update()
    {
        $pintor = Pintor::where('nombre', 'Leonardo Da Vinci')->first();
        $pintor->nombre = 'Leonardo di ser Piero da Vinci';
        $pintor->save();
    }

    public function remove()
    {
        $pintor = Pintor::find(1);
        $pintor->delete();
    }
}
