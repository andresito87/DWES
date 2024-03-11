<?php

namespace Tests\Unit;

use App\Models\Ubicacion;
use PHPUnit\Framework\TestCase;


class UbicacionUnitTest extends TestCase
{
    public function test_buscar_ubicacion_por_id_devuelve_ubicacion_correcta(): void
    {
        $ubicacion = new Ubicacion;
        $ubicacion->nombre = 'Biblioteca Municipal Distrito 4';
        $ubicacion->descripcion = 'Biblioteca Municipal del distrito 4. 6ª Avenida';
        $ubicacion->dias = 'L,M,X';
        $ubicacion->save();

        $ubicacionEncontrada = Ubicacion::find($ubicacion->id);

        $this->assertInstanceOf(Ubicacion::class, $ubicacionEncontrada);
        $this->assertEquals('Biblioteca Municipal Distrito 4', $ubicacionEncontrada->nombre);
        $this->assertEquals('Biblioteca Municipal del distrito 4. 6ª Avenida', $ubicacionEncontrada->descripcion);
        $this->assertEquals('L,M,X', $ubicacionEncontrada->dias);
    }
}