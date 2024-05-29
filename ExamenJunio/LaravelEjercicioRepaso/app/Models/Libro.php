<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Libro extends Model
{
    use HasFactory;
    protected $table = 'libros'; // no es necesario si la tabla se llama igual que el modelo en plural

    protected $fillable = ['titulo', 'autor', 'year']; // campos que se pueden rellenar

    protected $hidden = ['created_at', 'updated_at']; // campos que no se devuelven en las respuestas

    /*
       //Relación uno a muchos
       function autores() : HasMany
       {
           return $this->hasMany(Autor::class);
       }

       //Relación muchos a muchos
       function autor() : BelongsTo
       {
           return $this->belongsTo(Autor::class);
       }
       */

}
