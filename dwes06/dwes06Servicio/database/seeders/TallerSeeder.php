<?php

namespace Database\Seeders;

use App\Models\Taller;
use App\Models\Ubicacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        if (Ubicacion::where('dias', 'L,M,X')->count() > 0) {
            $ubicacion_id = Ubicacion::where('dias', 'L,M,X')->first()->id;
            $taller = new Taller;
            $taller->ubicacion_id = (int) $ubicacion_id;
            $taller->nombre = 'Taller de lectura';
            $taller->descripcion = 'Taller de lectura en la biblioteca';
            $taller->dia_semana = 'L';
            $taller->hora_inicio = '17:00';
            $taller->hora_fin = '18:00';
            $taller->cupo_maximo = 20;
            $taller->save();

            $taller = new Taller;
            $taller->ubicacion_id = (int) $ubicacion_id;
            $taller->nombre = 'Taller de escritura';
            $taller->descripcion = 'Taller de escritura en la academia de idiomas';
            $taller->dia_semana = 'X';
            $taller->hora_inicio = '17:00';
            $taller->hora_fin = '18:00';
            $taller->cupo_maximo = 20;
            $taller->save();
        }

        if (Ubicacion::where('dias', 'J,V')->count() > 0) {
            $ubicacion_id = Ubicacion::where('dias', 'J,V')->first()->id;
            $taller = new Taller;
            $taller->ubicacion_id = (int) $ubicacion_id;
            $taller->nombre = 'Taller de costura';
            $taller->descripcion = 'Taller de costura en el centro cívico';
            $taller->dia_semana = 'V';
            $taller->hora_inicio = '10:00';
            $taller->hora_fin = '12:00';
            $taller->cupo_maximo = 15;
            $taller->save();
        }

        if (Ubicacion::where('dias', 'S,D')->count() > 0) {
            $ubicacion_id = Ubicacion::where('dias', 'S,D')->first()->id;
            $taller = new Taller;
            $taller->ubicacion_id = (int) $ubicacion_id;
            $taller->nombre = 'Taller de natación';
            $taller->descripcion = 'Taller de natación en el polideportivo';
            $taller->dia_semana = 'D';
            $taller->hora_inicio = '10:00';
            $taller->hora_fin = '12:00';
            $taller->cupo_maximo = 10;
            $taller->save();
        }


        Taller::factory(30)->create();
    }
}
