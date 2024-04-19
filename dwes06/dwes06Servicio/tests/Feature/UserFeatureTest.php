<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserFeatureTest extends TestCase
{
    public function test_endpoint_obtener_usuarios_sin_estar_autenticado_redirige_a_login()
    {
        $response = $this->get('/api/users');
        $response->assertRedirect('/api/login');
        $response->assertStatus(302);
    }

    public function test_endpoint_obtener_todos_los_usuarios()
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

    public function test_endpoint_obtener_usuario()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/users/' . $usuario->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $usuario->id,
            'username' => $usuario->username,
            'email' => $usuario->email
        ]);

        $usuario->delete();
    }

    public function test_endpoint_obtener_usuario_no_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->get('/api/users/' . 9999999);

        $this->assertEquals(404, $response->status());

        $usuario->delete();
    }

    public function test_endpoint_crear_usuario()
    {
        $usuario = User::factory()->make();
        $response = $this->post('/api/signup', [
            'username' => $usuario->username,
            'email' => $usuario->email,
            'password' => $usuario->password,
            'password_confirmation' => $usuario->password
        ]);
        $response->assertStatus(201);
        $usuario = User::where('username', $usuario->username)->first();
        $token = $response->json()['token'];
        $response->assertJson([
            'user' => [
                'id' => $usuario->id,
                'username' => $usuario->username,
                'email' => $usuario->email,
                'created_at' => $usuario->created_at->toISOString(),
                'updated_at' => $usuario->updated_at->toISOString(),
            ],
            'token' => $token
        ]);

        $usuario->delete();
    }

    public function test_endpoint_crear_usuario_con_nombre_de_usuario_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->post('/api/signup', [
            'username' => $usuario->username,
            'email' => $usuario->email,
            'password' => $usuario->password,
            'password_confirmation' => $usuario->password
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'El nombre de usuario ya existe'
        ]);
    }

    public function test_endpoint_crear_usuario_con_email_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->post('/api/signup', [
            'username' => 'nuevo_usuario',
            'email' => $usuario->email,
            'password' => 'nueva_contraseña',
            'password_confirmation' => 'nueva_contraseña'
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'El email ya está en uso'
        ]);
    }

    public function test_endpoint_logout_usuario()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false]);

        $response = $this->post('/api/logout');
        $response->assertStatus(204);
    }

    public function test_endpoint_actualizar_usuario()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->put('/api/users/' . $usuario->id, [
                'username' => 'nuevo_usuario',
                'email' => 'prueba@test.com',
                'password' => 'nueva_contraseña',
                'password_confirmation' => 'nueva_contraseña'
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $usuario->id,
            'username' => 'nuevo_usuario',
            'email' => 'prueba@test.com',
        ]);

        $usuario->delete();
    }

    public function test_endpoint_eliminar_usuario()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/users/' . $usuario->id);

        $response->assertStatus(204);
        $response->assertNoContent();
    }

    public function test_endpoint_eliminar_usuario_no_existente()
    {
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)
            ->withSession(['banned' => false])
            ->delete('/api/users/' . 9999999);

        $this->assertEquals(404, $response->status());

        $usuario->delete();
    }
}