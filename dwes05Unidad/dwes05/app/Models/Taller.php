<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    // Indicamos el nombre de la tabla ya que no coincide con la pluralización de la clase(por defecto sería "tallers")
    protected $table = 'talleres';
    // Indicamos los campos que se pueden rellenar en la base de datos
    protected $fillable = ['ubicacion_id', 'nombre', 'descripcion', 'dia_semana', 'hora_inicio', 'hora_fin', 'cupo_maximo'];

    // Relación muchos a uno con la tabla "ubicaciones"(muchos talleres pueden tener una ubicación) o tambien llamada relación uno a muchos inversa
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Cuando se crea un taller, se garantiza que a la ubicación a la que pertenece el taller tenga el día de la semana en el que se imparte el taller
        static::created(function ($taller) {
            $ubicacion = $taller->ubicacion;
            $dias = $ubicacion->dias;
            if (strpos($dias, $taller->dia_semana) === false) {
                //Busca otra ubicacion random que tenga el dia de la semana en el que se imparte el taller
                $ubicacion = Ubicacion::where('dias', 'like', '%' . $taller->dia_semana . '%')->inRandomOrder()->first();
                if ($ubicacion) {
                    $taller->ubicacion_id = $ubicacion->id;
                    $taller->save();
                } else {
                    // Si no hay ninguna ubicación que tenga el día de la semana en el que se imparte el taller, se elimina el taller
                    $taller->delete();
                }
            }
        });
    }
}
