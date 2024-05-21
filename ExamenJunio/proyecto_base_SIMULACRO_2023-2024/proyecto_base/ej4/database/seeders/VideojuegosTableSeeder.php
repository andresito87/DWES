<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VideojuegosTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('videojuegos')->insert([
                'nombre' => 'Videojuego ' . $i,
                'anyo_lanzamiento' => rand(2000, 2022),
                'fecha_de_lanzamiento' => Carbon::create(rand(2000, 2022), rand(1, 12), rand(1, 28))->format('Y-m-d'),
            ]);
        }
    }
}
