<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UbicacionTest extends TestCase
{
    //setting up the database, migrate and seed
    public function test_configuracion_base_datos(): void
    {
        //Crear la base de datos con artisan
        Artisan::call('migrate:reset');
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed --class=UbicacionSeeder');
        Artisan::call('db:seed --class=TallerSeeder');

        $this->assertDatabaseHas('ubicaciones', [
            'nombre' => 'Biblioteca Municipal Distrito 4',
            'descripcion' => 'Biblioteca Municipal del distrito 4. 6ª Avenida',
            'dias' => 'L,M,X'
        ]);
        $response = $this->get(route('principal'));
        $response->assertOK();
        $response->assertSee('Bienvenido a la asociación Respira');
    }

    /**
     * A basic feature test example.
     */
    public function test_ruta_ubicaciones_muestra_una_lista_de_ubicaciones(): void
    {
        $response = $this->get(route('ubicaciones'));
        $response->assertOK();
        $response->assertSee('Biblioteca Municipal Distrito 4');
        $response->assertSee('Biblioteca Municipal del distrito 4. 6ª Avenida');
        $response->assertSee('Centro Cívico Distrito 4');
        $response->assertSee('Centro Cívico del distrito 4. Avenida de la Paloma');
        $response->assertSee('Polideportivo Ciudad Jardín');
        $response->assertSee('Polideportivo Ciudad Jardín. Avenida Jane Bones');
    }

    public function test_ruta_crear_ubicacion_muestra_formulario_creacion_de_ubicacion(): void
    {
        $response = $this->get(route('crear_ubicacion'));
        $response->assertOK();
        $response->assertSee('Formulario de creación de ubicación - Respira');
        $response->assertSee('Días en los que está disponible');
        $response->assertSee('<input type="submit" name="enviar" value="Crear nueva ubicación"', $escaped = false);
    }

    public function test_ruta_almacenar_ubicacion_almacena_ubicacion_en_base_datos(): void
    {
        $response = $this->post(route('almacenar_ubicacion_BD'), [
            'nombre' => 'C.D.R.F. Malagueña de Fútbol',
            'descripcion' => 'Centro Deportivo Real Federación Malagueña de Fútbol. Avenida de la Victoria',
            'dias' => ['V', 'S', 'D']
        ]);
        $response->assertRedirect(route('ubicaciones'));
        $this->assertDatabaseHas('ubicaciones', [
            'nombre' => 'C.D.R.F. Malagueña de Fútbol',
            'descripcion' => 'Centro Deportivo Real Federación Malagueña de Fútbol. Avenida de la Victoria',
            'dias' => 'V,S,D'
        ]);
    }

    public function test_ruta_detalles_ubicacion_muestra_datos_ubicacion_y_talleres(): void
    {
        $response = $this->get(route('detalles_ubicacion', ['ubicacion' => 1]));
        $response->assertSee('<p><strong>Nombre:</strong> Biblioteca Municipal Distrito 4</p>', $escaped = false);
        $response->assertSee('<p><strong>Descripción:</strong> Biblioteca Municipal del distrito 4. 6ª Avenida</p>', $escaped = false);
        $response->assertSee('<td>Taller de lectura</td>', $escaped = false);
        $response->assertSee('<td>Taller de lectura en la biblioteca</td>', $escaped = false);
    }

    public function test_ruta_editar_ubicacion_muestra_formulario_edicion_ubicacion(): void
    {
        $response = $this->get(route('editar_ubicacion', ['ubicacion' => 1]));
        $response->assertSee('Actualizar ubicación - Respira');
        $response->assertSee('<input type="submit" name="enviar" value="Actualizar"', $escaped = false);
    }

    public function test_ruta_actualizar_ubicacion_actualiza_ubicacion_en_base_datos(): void
    {
        $response = $this->post(route('actualizar_ubicacion', ['ubicacion' => 1]), [
            'nombre' => 'Prueba de nombre',
            'descripcion' => 'Prueba de descripción',
            'dias' => ['D']
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('ubicaciones'));
        $this->assertDatabaseHas('ubicaciones', [
            'nombre' => 'Prueba de nombre',
            'descripcion' => 'Prueba de descripción',
            'dias' => 'D'
        ]);

        $response = $this->post(route('actualizar_ubicacion', ['ubicacion' => 1]), [
            'nombre' => 'Biblioteca Municipal Distrito 4',
            'descripcion' => 'Biblioteca Municipal del distrito 4. 6ª Avenida',
            'dias' => ['L', 'M', 'X']
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('ubicaciones'));
        $this->assertDatabaseHas('ubicaciones', [
            'nombre' => 'Biblioteca Municipal Distrito 4',
            'descripcion' => 'Biblioteca Municipal del distrito 4. 6ª Avenida',
            'dias' => 'L,M,X'
        ]);
    }

    public function test_ruta_confirmar_borrar_ubicacion_muestra_formulario_confirmacion_borrar_ubicacion(): void
    {
        $response = $this->get(route('confirmar_borrar_ubicacion', ['ubicacion' => 1]));
        $response->assertOK();
        $response->assertSee('<title>Confirmar borrado de ubicación - Respira</title>', $escaped = false);
        $response->assertSee('<h3>Debe confirmar la eliminación para continuar, dado que se borrarán también todos los talleres de esta ubicación:', $escaped = false);
        $response->assertSee('<input type="submit" value="Borrar"></input>', $escaped = false);
    }

    public function test_ruta_borrar_ubicacion_borra_ubicacion_de_base_datos(): void
    {
        $response = $this->post(route('borrar_ubicacion', ['ubicacion' => 1, 'confirmar' => 'si']));
        $this->assertDatabaseMissing('ubicaciones', [
            'nombre' => 'Biblioteca Municipal Distrito 4',
            'descripcion' => 'Biblioteca Municipal del distrito 4. 6ª Avenida',
            'dias' => 'L,M,X'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('ubicaciones'));
        $response->assertSessionHas('mensaje', 'Ubicación eliminada correctamente');
    }

    public function test_ruta_almacenar_ubicacion_no_almacena_ubicacion_en_base_datos_si_no_se_introducen_datos(): void
    {
        $response = $this->post(route('almacenar_ubicacion_BD'), [
            'nombre' => '',
            'descripcion' => '',
            'dias' => ''
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['nombre' => 'El campo nombre es obligatorio.', 'descripcion' => 'El campo descripcion es obligatorio.', 'dias' => 'El campo dias es obligatorio.']);
    }

    public function test_ruta_almacenar_ubicacion_no_almacena_ubicacion_en_base_datos_si_no_se_introducen_datos_correctos(): void
    {
        $response = $this->post(route('almacenar_ubicacion_BD'), [
            'nombre' => 'Nombre Prueba',
            'descripcion' => 'descripcion prueba',
            'dias' => ['F']
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'dias.0' => 'El dias.0 seleccionado no es válido.'
        ]);
        $response->isRedirect(route('crear_ubicacion'));
    }

    public function test_ruta_ubicacion_que_no_existe_devuelve_error_404(): void
    {
        $response = $this->get(route('detalles_ubicacion', ['ubicacion' => 1000]));
        $response->assertStatus(404);
        $response->assertSee('404');
        $response->assertSee('No encontrado');
    }

}
