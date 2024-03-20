<?php

namespace Tests\Unit;

use App\Models\Taller;
use App\Models\Ubicacion;
use Illuminate\Database\QueryException;
use Tests\TestCase;


class UbicacionUnitTest extends TestCase
{
    public function test_asegurar_que_se_puede_crear_ubicacion()
    {
        $ubicacion = Ubicacion::factory()->make();
        $this->assertInstanceOf(Ubicacion::class, $ubicacion);
    }

    public function test_comprobar_que_se_puede_guardar_ubicacion_en_base_datos()
    {
        $ubicacion = Ubicacion::factory()->create();
        $this->assertInstanceOf(Ubicacion::class, $ubicacion);
        // Crear un array que represente el orden deseado de los días de la semana
        $ordenDias = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        // Dividir la cadena en un array
        $diasArray = explode(',', $ubicacion->dias);
        // Crear un mapa de índices para los días de la semana
        $indiceDias = array_flip($ordenDias);
        // Ordenar el array de acuerdo al orden deseado de los días
        usort($diasArray, function ($a, $b) use ($indiceDias) {
            return $indiceDias[$a] - $indiceDias[$b];
        });
        // Convertir el array ordenado de vuelta a una cadena
        $diasOrdenadosString = implode(',', $diasArray);
        $this->assertDatabaseHas('ubicaciones', [
            'nombre' => $ubicacion->nombre,
            'descripcion' => $ubicacion->descripcion,
            'dias' => $diasOrdenadosString
        ]);
    }

    public function test_comprobar_que_se_puede_borrar_ubicacion_de_la_base_datos()
    {
        $ubicacion = Ubicacion::factory()->create();
        $this->assertInstanceOf(Ubicacion::class, $ubicacion);
        $ubicacion->delete();
        $this->assertDatabaseMissing('ubicaciones', [
            'nombre' => $ubicacion->nombre,
            'descripcion' => $ubicacion->descripcion,
            'dias' => $ubicacion->dias
        ]);
    }

    public function test_comprobar_que_se_puede_actualizar_ubicacion_en_la_base_datos()
    {
        $ubicacion = Ubicacion::factory()->create();
        $this->assertInstanceOf(Ubicacion::class, $ubicacion);
        $ubicacion->nombre = 'Nombre Actualizado';
        $ubicacion->descripcion = 'Descripción Actualizada';
        $ubicacion->dias = 'V,S,D';
        $ubicacion->save();
        $this->assertDatabaseHas('ubicaciones', [
            'nombre' => $ubicacion->nombre,
            'descripcion' => $ubicacion->descripcion,
            'dias' => $ubicacion->dias
        ]);
    }

    public function test_comprobar_que_se_puede_obtener_talleres_de_ubicacion()
    {
        $ubicacion = Ubicacion::factory()->create();
        $this->assertInstanceOf(Ubicacion::class, $ubicacion);
        $talleres = $ubicacion->talleres;
        $this->assertIsIterable($talleres);
        $this->assertContainsOnlyInstancesOf(Taller::class, $talleres);
    }

    public function test_comprobar_que_se_no_puede_guardar_ubicacion_sin_nombre()
    {
        $ubicacion = Ubicacion::factory()->make(['nombre' => '']);
        $this->assertEmpty($ubicacion->nombre);
        $this->assertDatabaseMissing('ubicaciones', [
            'nombre' => $ubicacion->nombre,
            'descripcion' => $ubicacion->descripcion,
            'dias' => $ubicacion->dias
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_ubicacion_sin_descripcion()
    {
        $ubicacion = Ubicacion::factory()->make(['descripcion' => '']);
        $this->assertEmpty($ubicacion->descripcion);
        $this->assertDatabaseMissing('ubicaciones', [
            'nombre' => $ubicacion->nombre,
            'descripcion' => $ubicacion->descripcion,
            'dias' => $ubicacion->dias
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_ubicacion_sin_dias()
    {
        $ubicacion = Ubicacion::factory()->make(['dias' => '']);
        $this->assertEmpty($ubicacion->dias);
        $this->assertDatabaseMissing('ubicaciones', [
            'nombre' => $ubicacion->nombre,
            'descripcion' => $ubicacion->descripcion,
            'dias' => $ubicacion->dias
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_ubicacion_con_dias_invalidos()
    {
        // Intenta crear una ubicación con días no válidos, se lanza una excepción en la base de datos
        $this->expectException(QueryException::class);
        Ubicacion::factory()->create(['dias' => 'L,M,X,Y']);
    }

    public function test_comprobar_que_se_no_puede_guardar_ubicacion_con_nombre_demasiado_largo()
    {
        // Intenta crear una ubicación con un nombre demasiado largo, se lanza una excepción de validación
        $this->expectException(QueryException::class);
        Ubicacion::factory()->create(['nombre' => 'Nombre de ubicación demasiado largooooooooooooooooooooooooooo']);
    }

    public function test_comprobar_que_devuelve_error_si_no_se_encuentra_ubicacion()
    {
        $ubicacion = Ubicacion::find(999);
        $this->assertNull($ubicacion);
    }
}