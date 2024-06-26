<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        User::factory(30)->create();

        // Ejecutar el seeder de ubicaciones
        $this->call(UbicacionSeeder::class);

        // Ejecutar el seeder de talleres
        $this->call(TallerSeeder::class);

        // Usuario de prueba
        User::factory()->create([
            'username' => 'prueba',
            'email' => 'prueba@example.com',
            'password' => bcrypt('prueba')
        ]);

    }
}
