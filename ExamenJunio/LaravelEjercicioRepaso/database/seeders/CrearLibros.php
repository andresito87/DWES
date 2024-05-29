<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Libro;
use Termwind\Components\Li;

class CrearLibros extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        Libro::create([
            'titulo' => 'El Quijote',
            'autor' => 'Miguel de Cervantes',
            'year' => 1605
        ]);

        Libro::create([
            'titulo' => 'Hombre Rico, Hombre Pobre',
            'autor' => 'Irwin Shaw',
            'year' => 1970
        ]);

        Libro::create([
            'titulo' => 'El Padrino',
            'autor' => 'Mario Puzo',
            'year' => 1969
        ]);

        Libro::create([
            'titulo' => 'El Señor de los Anillos',
            'autor' => 'J.R.R. Tolkien',
            'year' => 2000
        ]);
    }
}
