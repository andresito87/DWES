<?php

namespace Tests\Feature;

use App\Models\Taller;
use Tests\TestCase;
use App\Models\User;

class TallerFeatureTest extends TestCase
{
    public function test_endpoint_obtener_talleres_sin_estar_autenticado_redirige_a_login()
    {
        $response = $this->get('/api/workshops');
        $response->assertRedirect('/api/login');
        $response->assertStatus(302);
    }

    public function test_endpoint_obtener_todos_los_talleres()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'links',
                'meta'
            ]);
        $usuario->delete();
    }

    public function test_endpoint_obtener_taller()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/workshops/1');
        $taller = Taller::find(1);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $taller->id,
            'nombre' => $taller->nombre,
            'descripcion' => $taller->descripcion,
            'ubicacion_id' => $taller->ubicacion_id,
            'dia_semana' => $taller->dia_semana,
            'hora_inicio' => $taller->hora_inicio,
            'hora_fin' => $taller->hora_fin,
            'cupo_maximo' => $taller->cupo_maximo
        ]);

        $usuario->delete();
    }

    public function test_endpoint_obtener_taller_no_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/workshops/9999999');

        $this->assertEquals(404, $response->status());

        $usuario->delete();
    }

    public function test_endpoint_crear_taller()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->post('/api/workshops', [
                'ubicacion_id' => 1,
                'nombre' => 'Taller de prueba',
                'descripcion' => 'Descripción del taller de prueba',
                'dia_semana' => 'L',
                'hora_inicio' => '10:00',
                'hora_fin' => '12:00',
                'cupo_maximo' => 10
            ]);

        $response->assertStatus(201);
        $response->assertJson([
            'nombre' => 'Taller de prueba',
            'descripcion' => 'Descripción del taller de prueba',
            'ubicacion_id' => 1,
            'dia_semana' => 'L',
            'hora_inicio' => '10:00',
            'hora_fin' => '12:00',
            'cupo_maximo' => 10
        ]);

        $usuario->delete();
    }

    public function test_endpoint_crear_taller_con_ubicacion_no_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->post('/api/workshops', [
                'ubicacion_id' => 9999999,
                'nombre' => 'Taller de prueba',
                'descripcion' => 'Descripción del taller de prueba',
                'dia_semana' => 'L',
                'hora_inicio' => '10:00',
                'hora_fin' => '12:00',
                'cupo_maximo' => 10
            ]);

        $this->assertEquals(404, $response->status());
        $this->assertEquals('Ubicación no encontrada', $response->json()['message']);

        $usuario->delete();
    }

    public function test_endpoint_crear_taller_con_dia_no_disponible_en_ubicacion()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->post('/api/workshops', [
                'ubicacion_id' => 1,
                'nombre' => 'Taller de prueba',
                'descripcion' => 'Descripción del taller de prueba',
                'dia_semana' => 'D',
                'hora_inicio' => '10:00',
                'hora_fin' => '12:00',
                'cupo_maximo' => 10
            ]);

        $this->assertEquals(422, $response->status());
        $this->assertEquals('Día no disponible en la ubicación', $response->json()['message']);

        $usuario->delete();
    }

    public function test_endpoint_actualizar_taller()
    {
        $usuario = User::factory()->create();
        $taller = Taller::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->put('/api/workshops/' . $taller->id, [
                'ubicacion_id' => 1,
                'nombre' => 'Taller de prueba actualizado',
                'descripcion' => 'Descripción del taller de prueba actualizado',
                'dia_semana' => 'L',
                'hora_inicio' => '10:00',
                'hora_fin' => '12:00',
                'cupo_maximo' => 10
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'nombre' => 'Taller de prueba actualizado',
            'descripcion' => 'Descripción del taller de prueba actualizado',
            'ubicacion_id' => 1,
            'dia_semana' => 'L',
            'hora_inicio' => '10:00',
            'hora_fin' => '12:00',
            'cupo_maximo' => 10
        ]);

        $usuario->delete();
        $taller->delete();
    }

    public function test_endpoint_actualizar_taller_con_ubicacion_no_existente()
    {
        $usuario = User::factory()->create();
        $taller = Taller::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->put('/api/workshops/' . $taller->id, [
                'ubicacion_id' => 9999999,
                'nombre' => 'Taller de prueba actualizado',
                'descripcion' => 'Descripción del taller de prueba actualizado',
                'dia_semana' => 'L',
                'hora_inicio' => '10:00',
                'hora_fin' => '12:00',
                'cupo_maximo' => 10
            ]);

        $this->assertEquals(404, $response->status());
        $this->assertEquals('Ubicación no encontrada', $response->json()['message']);

        $usuario->delete();
        $taller->delete();
    }

    public function test_endpoint_actualizar_taller_con_dia_no_disponible_en_ubicacion()
    {
        $usuario = User::factory()->create();
        $taller = Taller::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->put('/api/workshops/' . $taller->id, [
                'ubicacion_id' => 1,
                'nombre' => 'Taller de prueba actualizado',
                'descripcion' => 'Descripción del taller de prueba actualizado',
                'dia_semana' => 'D',
                'hora_inicio' => '10:00',
                'hora_fin' => '12:00',
                'cupo_maximo' => 10
            ]);

        $this->assertEquals(422, $response->status());
        $this->assertEquals('Día no disponible en la ubicación', $response->json()['message']);

        $usuario->delete();
        $taller->delete();
    }

    public function test_endpoint_eliminar_taller()
    {
        $usuario = User::factory()->create();
        $taller = Taller::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/workshops/' . $taller->id);

        $response->assertStatus(204);
        $this->assertNull(Taller::find($taller->id));

        $usuario->delete();
    }

    public function test_endpoint_eliminar_taller_no_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/workshops/9999999');

        $this->assertEquals(404, $response->status());

        $usuario->delete();
    }

    public function test_endpoint_eliminar_taller_sin_estar_autenticado_redirige_a_login()
    {
        $response = $this->delete('/api/workshops/1');
        $response->assertRedirect('/api/login');
        $response->assertStatus(302);
    }

    public function test_endpoint_actualizar_taller_sin_estar_autenticado_redirige_a_login()
    {
        $response = $this->put('/api/workshops/1');
        $response->assertRedirect('/api/login');
        $response->assertStatus(302);
    }

    public function test_endpoint_crear_taller_sin_estar_autenticado_redirige_a_login()
    {
        $response = $this->post('/api/workshops');
        $response->assertRedirect('/api/login');
        $response->assertStatus(302);
    }

    public function test_endpoint_obtener_taller_sin_estar_autenticado_redirige_a_login()
    {
        $response = $this->get('/api/workshops/1');
        $response->assertRedirect('/api/login');
        $response->assertStatus(302);
    }
}
