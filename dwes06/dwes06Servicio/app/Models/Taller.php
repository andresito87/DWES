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
}
