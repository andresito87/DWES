<?php

namespace Database\Factories;

use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Taller>
 */
class TallerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        // Día de la semana aleatorio donde se imparte el taller
        $dia_semana = $this->faker->randomElement(['L', 'M', 'X', 'J', 'V', 'S', 'D']);
        // Buscar una ubicación que tenga el día de la semana en el que se imparte el taller
        $ubicaciones = Ubicacion::where('dias', 'like', '%' . $dia_semana . '%')->get();
        $ubicacion = $ubicaciones->random();
        $hora_inicio = $this->faker->time('H:i');
        $hora_fin = $this->faker->time('H:i');
        do {
            $hora_inicio = $this->faker->time('H:i');
            $hora_fin = $this->faker->time('H:i');
        } while ($hora_fin <= $hora_inicio);

        return [
            'ubicacion_id' => $ubicacion->id,
            'nombre' => 'Taller de ' . $this->faker->randomElement(['lectura', 'costura', 'cocina', 'informática', 'música', 'teatro', 'pintura', 'dibujo', 'baile', 'yoga', 'pilates', 'gimnasia', 'fútbol', 'baloncesto', 'voleibol', 'tenis', 'natación', 'atletismo', 'ciclismo', 'senderismo', 'montañismo', 'escalada', 'surf', 'kayak', 'paddle surf', 'esquí', 'snowboard', 'patinaje', 'skate', 'bmx', 'parkour', 'crossfit', 'boxeo', 'kickboxing', 'muay thai', 'jiu jitsu', 'karate', 'taekwondo', 'kung fu', 'aikido', 'judo', 'esgrima', 'tiro con arco', 'tiro con rifle', 'tiro con pistola', 'tiro con ballesta', 'programacion PHP', 'programacion Java', 'programacion C#', 'programacion Python', 'programacion Ruby', 'programacion Swift', 'programacion Kotlin', 'programacion Go', 'programacion Rust', 'programacion TypeScript', 'programacion JavaScript', 'programacion HTML', 'programacion CSS', 'programacion SQL', 'ajedrez', 'damas', 'parchís', 'dominó', 'poker', 'bridge', 'chinchón', 'mus', 'tute', 'brisca', 'cinquillo', 'parchís', 'soft-skills', 'pensamiento crítico', 'diléctica', 'historia', 'filosofía', 'psicología', 'sociología', 'economía', 'política', 'derecho', 'geografía', 'biología', 'física', 'química', 'matemáticas', 'estadística', 'informática', 'tecnología', 'ingeniería', 'arquitectura', 'diseño', 'arte', 'música', 'cine', 'literatura', 'teatro', 'danza', 'pintura', 'escultura', 'fotografía', 'moda', 'gastronomía', 'enología', 'coctelería', 'pastelería', 'repostería', 'panadería', 'heladería', 'chocolatería', 'cafetería', 'restauración', 'hostelería', 'turismo', 'viajes', 'aventura', 'naturaleza', 'ecología', 'sostenibilidad', 'medio ambiente', 'reciclaje', 'energías renovables', 'cambio climático', 'calentamiento global', 'contaminación', 'biodiversidad', 'fauna', 'flora', 'ecosistemas', 'biomas', 'geología', 'meteorología', 'climatología', 'hidrología', 'hidrogeología', 'hidrografía', 'oceanografía', 'limnología', 'glaciología', 'vulcanología', 'sismología', 'tectónica de placas', 'geomorfología', 'geodesia', 'cartografía', 'topografía', 'geofísica', 'geodesia', 'geotermia', 'geofísica', 'geotecnología', 'geotecnia', 'geohidrología', 'geomecánica']),
            'descripcion' => $this->faker->sentence(4),
            'dia_semana' => $dia_semana,
            'hora_inicio' => $this->faker->time('H:i'),
            'hora_fin' => $this->faker->time('H:i'),
            'cupo_maximo' => $this->faker->numberBetween(10, 30)
        ];
    }
}
