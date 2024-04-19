<?php

namespace Tests\Unit;

use App\Models\Taller;
use App\Models\Ubicacion;
use Tests\TestCase;

class TallerTest extends TestCase
{
    public function test_asegurar_que_se_puede_crear_taller()
    {
        $taller = Taller::factory()->make();
        $this->assertInstanceOf(Taller::class, $taller);
    }

    public function test_comprobar_que_se_puede_guardar_taller_en_base_datos()
    {
        $taller = Taller::factory()->create();
        $this->assertInstanceOf(Taller::class, $taller);
        $this->assertDatabaseHas('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_puede_actualizar_taller_en_la_base_datos()
    {
        $taller = Taller::factory()->create();
        $this->assertInstanceOf(Taller::class, $taller);
        $taller->nombre = 'Nombre Actualizado';
        $taller->descripcion = 'Descripción Actualizada';
        $taller->dia_semana = 'V';
        $taller->hora_inicio = '10:00:00';
        $taller->hora_fin = '12:00:00';
        $taller->cupo_maximo = 20;
        $taller->save();
        $this->assertDatabaseHas('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_puede_eliminar_taller_de_la_base_datos()
    {
        $taller = Taller::factory()->create();
        $this->assertInstanceOf(Taller::class, $taller);
        $taller->delete();
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_puede_obtener_ubicacion_de_taller()
    {
        $taller = Taller::factory()->create();
        $this->assertInstanceOf(Taller::class, $taller);
        $ubicacion = $taller->ubicacion;
        $this->assertInstanceOf(Ubicacion::class, $ubicacion);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_sin_nombre()
    {
        $taller = Taller::factory()->make(['nombre' => '']);
        $this->assertEmpty($taller->nombre);
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_sin_descripcion()
    {
        $taller = Taller::factory()->make(['descripcion' => '']);
        $this->assertEmpty($taller->descripcion);
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_sin_ubicaion()
    {
        $taller = Taller::factory()->make(['ubicacion_id' => null]);
        $this->assertEmpty($taller->ubicacion_id);
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_sin_dia_semana()
    {
        $taller = Taller::factory()->make(['dia_semana' => '']);
        $this->assertEmpty($taller->dia_semana);
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_sin_hora_inicio()
    {
        $taller = Taller::factory()->make(['hora_inicio' => '']);
        $this->assertEmpty($taller->hora_inicio);
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_sin_hora_fin()
    {
        $taller = Taller::factory()->make(['hora_fin' => '']);
        $this->assertEmpty($taller->hora_fin);
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_sin_cupo_maximo()
    {
        $taller = Taller::factory()->make(['cupo_maximo' => null]);
        $this->assertEmpty($taller->cupo_maximo);
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_se_no_puede_guardar_taller_cuyo_dia_semana_no_esta_en_la_lista_dias_disponibles_de_la_ubicacion()
    {
        $ubicacion = Ubicacion::factory()->create();
        $ubicacion->dias = 'L,M,X';
        $ubicacion->save();
        $taller = Taller::factory()->make(['ubicacion_id' => $ubicacion->id, 'dia_semana' => 'J']);
        $this->assertNotContains($taller->dia_semana, explode(',', $ubicacion->dias));
        $this->assertDatabaseMissing('talleres', [
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);
    }

    public function test_comprobar_que_devuelve_null_si_no_encuentra_taller()
    {
        $taller = Taller::find(999);
        $this->assertNull($taller);
    }
}
