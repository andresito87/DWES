<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_asegurar_que_se_puede_crear_usuario()
    {
        $usuario = User::factory()->make();
        $this->assertInstanceOf(User::class, $usuario);

    }

    public function test_comprobar_que_se_puede_guardar_usuario_en_base_datos()
    {
        $usuario = User::factory()->create();
        $this->assertInstanceOf(User::class, $usuario);
        $this->assertDatabaseHas('users', [
            'username' => $usuario->username,
            'email' => $usuario->email,
            'password' => $usuario->password
        ]);
    }

    public function test_comprobar_que_se_puede_actualizar_usuario_en_la_base_datos()
    {
        $usuario = User::factory()->create();
        $this->assertInstanceOf(User::class, $usuario);
        $usuario->username = 'Nombre Actualizado';
        $usuario->save();
        $this->assertDatabaseHas('users', [
            'username' => $usuario->username,
            'email' => $usuario->email,
            'password' => $usuario->password
        ]);
        //eliminamos el usuario creado
        $usuario->delete();
    }

    public function test_comprobar_que_se_puede_eliminar_usuario_de_la_base_datos()
    {
        $usuario = User::factory()->create();
        $this->assertInstanceOf(User::class, $usuario);
        $usuario->delete();
        $this->assertDatabaseMissing('users', [
            'username' => $usuario->username,
            'email' => $usuario->email,
            'password' => $usuario->password
        ]);
    }

    public function test_comprobar_que_se_puede_obtener_usuario_existente()
    {
        $userCreado = User::factory()->create();
        $this->assertInstanceOf(User::class, $userCreado);
        $usuarioBuscado = User::find($userCreado->id);
        $this->assertInstanceOf(User::class, $usuarioBuscado);
        $this->assertEquals($userCreado->id, $usuarioBuscado->id);
    }
}
