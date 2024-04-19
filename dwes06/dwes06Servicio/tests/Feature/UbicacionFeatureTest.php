<?php

namespace Tests\Feature;

use App\Models\Taller;
use Tests\TestCase;
use App\Models\Ubicacion;
use App\Models\User;

class UbicacionFeatureTest extends TestCase
{
    public function test_endpoint_obtener_ubicaciones_sin_estar_autenticado_redirige_a_login()
    {
        $response = $this->get('/api/ubications');
        $response->assertStatus(302);
        $response->assertRedirect('/api/login');
    }

    public function test_endpoint_obtener_todas_las_ubicaciones()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/ubications');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'links',
                'meta'
            ]);

        $usuario->delete();
    }

    public function test_endpoint_obtener_ubicacion()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/ubications/1');
        $ubicacion = Ubicacion::find(1);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $ubicacion->id,
            'nombre' => $ubicacion->nombre,
            'descripcion' => $ubicacion->descripcion,
            'dias' => $ubicacion->dias
        ]);

        $usuario->delete();
    }

    public function test_endpoint_obtener_ubicacion_no_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/ubications/1000');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Ubicación no encontrada'
        ]);

        $usuario->delete();
    }

    public function test_endpoint_crear_ubicacion()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->post('/api/ubications', [
                'nombre' => 'Ubicacion de prueba',
                'descripcion' => 'Ubicacion de prueba',
                'dias' => 'L,M,X,J,V,S,D'
            ]);

        $response->assertStatus(201);
        $response->assertJson([
            'nombre' => 'Ubicacion de prueba',
            'descripcion' => 'Ubicacion de prueba',
            'dias' => 'L,M,X,J,V,S,D'
        ]);

        $usuario->delete();
    }

    public function test_endpoint_actualizar_ubicacion()
    {
        $usuario = User::factory()->create();
        $ubicacion = Ubicacion::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->put('/api/ubications/' . $ubicacion->id, [
                'nombre' => 'Ubicacion de prueba',
                'descripcion' => 'Ubicacion de prueba',
                'dias' => 'L,M,X,J,V,S,D'
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'nombre' => 'Ubicacion de prueba',
            'descripcion' => 'Ubicacion de prueba',
            'dias' => 'L,M,X,J,V,S,D'
        ]);

        $usuario->delete();
    }

    public function test_endpoint_eliminar_ubicacion()
    {
        $usuario = User::factory()->create();
        $ubicacion = Ubicacion::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/ubications/' . $ubicacion->id);

        $response->assertStatus(204);
        $response->assertNoContent();

        $usuario->delete();
    }

    public function test_endpoint_eliminar_ubicacion_no_existente()
    {
        $usuario = User::factory()->create();
        $ubicacion = Ubicacion::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/ubications/' . $ubicacion->id);

        $response->assertStatus(204);
        $response->assertNoContent();

        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/ubications/' . $ubicacion->id);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Ubicación no encontrada'
        ]);
    }

    public function test_endpoint_eliminar_ubicacion_elimina_talleres_asociados()
    {
        $usuario = User::factory()->create();
        $ubicacion = Ubicacion::factory()->create();
        $taller = Taller::factory()->create([
            'ubicacion_id' => $ubicacion->id
        ]);
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/ubications/' . $ubicacion->id);

        $response->assertStatus(204);
        $response->assertNoContent();

        $this->assertNull(Taller::find($taller->id));
        $this->assertNull(Ubicacion::find($ubicacion->id));
    }

}
