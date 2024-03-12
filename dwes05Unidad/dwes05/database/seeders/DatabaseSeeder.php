<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Usando el comando 'php artisan db:seed' se resetea la base de datos y se ejecutan los seeders
        Artisan::call('migrate:reset');
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => UbicacionSeeder::class]);
        Artisan::call('db:seed', ['--class' => TallerSeeder::class]);
    }
}
