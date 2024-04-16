<?php

namespace Database\Seeders;

use App\Models\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        if (Ubicacion::where('nombre', 'Biblioteca Municipal Distrito 4')->where('descripcion', 'Biblioteca Municipal del distrito 4. 6ª Avenida')->where('dias', 'L,M,X')->count() == 0) {
            $ubicacion = new Ubicacion;
            $ubicacion->nombre = 'Biblioteca Municipal Distrito 4';
            $ubicacion->descripcion = 'Biblioteca Municipal del distrito 4. 6ª Avenida';
            $ubicacion->dias = 'L,M,X';
            $ubicacion->save();
        }

        if (Ubicacion::where('nombre', 'Centro Cívico Distrito 4')->where('descripcion', 'Centro Cívico del distrito 4. Avenida de la Paloma')->where('dias', 'J,V')->count() == 0) {
            $ubicacion = new Ubicacion;
            $ubicacion->nombre = 'Centro Cívico Distrito 4';
            $ubicacion->descripcion = 'Centro Cívico del distrito 4. Avenida de la Paloma';
            $ubicacion->dias = 'J,V';
            $ubicacion->save();
        }

        if (Ubicacion::where('nombre', 'Polideportivo Ciudad Jardín')->where('descripcion', 'Polideportivo Ciudad Jardín. Avenida Jane Bones')->where('dias', 'S,D')->count() == 0) {
            $ubicacion = new Ubicacion;
            $ubicacion->nombre = 'Polideportivo Ciudad Jardín';
            $ubicacion->descripcion = 'Polideportivo Ciudad Jardín. Avenida Jane Bones';
            $ubicacion->dias = 'S,D';
            $ubicacion->save();
        }

        if (Ubicacion::where('nombre', 'Polideportivo Central')->where('descripcion', 'Polideportivo Central. Avenida Simon Bolivar')->where('dias', 'S,D')->count() == 0) {
            $ubicacion = new Ubicacion;
            $ubicacion->nombre = 'Polideportivo Central';
            $ubicacion->descripcion = 'Polideportivo Central. Avenida Simon Bolivar';
            $ubicacion->dias = 'M,X';
            $ubicacion->save();
        }

        Ubicacion::factory(30)->create();
    }
}
