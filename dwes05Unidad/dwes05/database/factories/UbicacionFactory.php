<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ubicacion>
 */
class UbicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array de días de la semana aleatorios
        $dias = $this->faker->randomElements(['L', 'M', 'X', 'J', 'V', 'S', 'D'], $this->faker->numberBetween(1, 3));
        return [
            'nombre' => $this->faker->randomElement(['Biblioteca', 'Centro Cívico', 'Polideportivo', 'Centro Deportivo', 'Parque', 'Plaza', 'Colegio', 'Instituto', 'Universidad']) . ' ' . $this->faker->name,
            'descripcion' => $this->faker->streetAddress(),
            'dias' => implode(',', $dias)
        ];
    }
}
