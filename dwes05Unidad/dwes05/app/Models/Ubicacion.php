<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    // Indicamos el nombre de la tabla ya que no coincide con la pluralización de la clase(por defecto sería "ubicacions")
    protected $table = 'ubicaciones';
    // Indicamos los campos que se pueden rellenar en la base de datos
    protected $fillable = ['nombre', 'descripcion', 'dias'];

    // Relación uno a muchos con la tabla "talleres"(una ubicación puede tener varios talleres)
    public function talleres()
    {
        return $this->hasMany(Taller::class);
    }
}
