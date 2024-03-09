<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Autor;
use App\Models\Libro;

class RelacionNMController extends Controller
{
    public function agregar()
    {
        $autor1 = new Autor;
        $autor1->nombre = 'Brian Wilson';
        $autor1->apellido = 'Kernighan';
        $autor1->save();

        $autor2 = new Autor;
        $autor2->nombre = 'Dennis MacAlistair';
        $autor2->apellido = 'Ritchie';
        $autor2->save();

        $autor3 = new Autor;
        $autor3->nombre = 'Robert';
        $autor3->apellido = 'Pike';
        $autor3->save();

        $autor4 = new Autor;
        $autor4->nombre = 'Phillip James';
        $autor4->apellido = 'Plauger';
        $autor4->save();

        $libro1 = new Libro;
        $libro1->título = 'The C Programming Language';
        $libro1->año_publicación = '1978';
        $libro1->save();

        $libro2 = new Libro;
        $libro2->título = 'The Unix Programming Environment';
        $libro2->año_publicación = '1984';
        $libro2->save();

        $libro3 = new Libro;
        $libro3->título = 'The Elements of Programming Style';
        $libro3->año_publicación = '1978';
        $libro3->save();

        $libro4 = new Libro;
        $libro4->título = 'The Standard C Library';
        $libro4->año_publicación = '1992';
        $libro4->save();

        $libro1->autores()->attach([$autor1->id, $autor2->id]);
        $libro2->autores()->attach([$autor1->id, $autor3->id]);
        $libro3->autores()->attach([$autor1->id, $autor4->id]);
        $libro4->autores()->attach([$autor4->id]);

        return 'Autores y libros insertados y relacionados en la BBDD.';
    }

    public function ver()
    {
        $autores = Autor::all();

        foreach ($autores as $autor) {
            echo $autor->nombre . ' ' . $autor->apellido;
            echo ' es autor de:';

            echo '<ul>';

            foreach ($autor->libros as $libro) {
                echo '<li>' . $libro->título;
                echo ' (' . $libro->año_publicación . ').</li>';
            }

            echo '</ul>';
        }
    }

    public function mostrar()
    {
        $libros = Libro::all();

        foreach ($libros as $libro) {
            echo 'El libro ' . $libro->título . ' (';
            echo $libro->año_publicación . ') está escrito por:';

            echo '<ul>';

            foreach ($libro->autores as $autor) {
                echo '<li>' . $autor->nombre;
                echo ' ' . $autor->apellido . '.</li>';
            }

            echo '</ul>';
        }
    }
}