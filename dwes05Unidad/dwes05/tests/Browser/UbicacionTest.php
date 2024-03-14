<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Browser;
use Symfony\Component\Console\Input\Input;
use Tests\DuskTestCase;

class UbicacionTest extends DuskTestCase
{
    public function testSetUp(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed --class=UbicacionSeeder');
        Artisan::call('db:seed --class=TallerSeeder');


        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Bienvenido a la asociación Respira');
        });
    }
    /**
     * Comprueba que se muestra la pantalla de bienvenida.
     */
    public function testMuestraPantallaBienvenida(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Bienvenido a la asociación Respira');
        });
    }

    /**
     * Comprueba que se muestra la lista de ubicaciones.
     */
    public function testMuestraListaUbicaciones(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones')
                ->assertSee('Lista de ubicaciones');
        });
    }

    /**
     * Comprueba que se muestra el formulario para crear una nueva ubicación.
     */
    public function testMuestraFormularioCrearUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/create')
                ->assertSee('Nombre')
                ->assertSee('Descripción')
                ->assertSee('Días en los que está disponible')
                ->assertSee('Crear nueva ubicación');
        });
    }

    /**
     * Comprueba que se puede crear una nueva ubicación.
     */
    public function testCrearUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/create')
                ->type('nombre', 'Ubicación de prueba')
                ->type('descripcion', 'Descripción de la ubicación de prueba')
                ->check('dias[]', 'L')
                ->check('dias[]', 'M')
                ->check('dias[]', 'X')
                ->press('Crear nueva ubicación')
                ->assertPathIs('/ubicaciones')
                ->assertSee('Ubicación creada correctamente');
        });
    }

    /**
     * Comprueba que se muestra el formulario para editar una ubicación.
     */
    public function testMuestraFormularioEditarUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/2/edit')
                ->assertSee('Nombre')
                ->assertSee('Descripción')
                ->assertSee('Días:')
                ->assertSourceHas('<input type="submit" value="Actualizar">');
        });
    }

    /**
     * Comprueba que se puede editar una ubicación.
     */
    public function testEditarUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/2/edit')
                ->type('nombre', 'Ubicación de prueba editada')
                ->type('descripcion', 'Descripción de la ubicación de prueba editada')
                ->check('dias[]', 'L')
                ->check('dias[]', 'M')
                ->check('dias[]', 'X')
                ->press('Actualizar')
                ->assertPathIs('/ubicaciones')
                ->assertSee('Ubicación actualizada correctamente');
        });
    }

    /**
     * Comprueba que se muestra la ubicación especificada.
     */
    public function testMuestraUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/2')
                ->assertSee('Ubicación de prueba editada')
                ->assertSee('Descripción de la ubicación de prueba editada')
                ->assertSee('L');
        });
    }

    /**
     * Comprueba que se muestra los inputs rellenos con los datos de la ubicación.
     */
    public function testMuestraInputsRellenosUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/2/edit')
                ->assertInputValue('nombre', 'Ubicación de prueba editada')
                ->assertInputValue('descripcion', 'Descripción de la ubicación de prueba editada')
                ->assertChecked('dias[]', 'L');
        });
    }

    /**
     * Comprueba que se muestra el formulario de confirmación de borrado de una ubicación.
     */
    public function testMuestraFormularioConfirmacionBorrarUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/2/destroyconfirm')
                ->assertSourceHas('<title>Confirmar borrado de ubicación - Respira</title>')
                ->assertSee('Debe confirmar la eliminación para continuar, dado que se borrarán también todos los talleres de esta ubicación:')
                ->assertSourceHas('<input type="submit" value="Borrar">');
        });
    }

    /**
     * Comprueba que se puede borrar una ubicación.
     */
    public function testBorrarUbicacion(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/16/destroyconfirm')
                ->click('input[type=radio][value=si]')
                ->press('Borrar')
                ->assertPathIs('/ubicaciones')
                ->assertSee('Ubicación eliminada correctamente');
        });
    }

    /**
     * Comprueba que se muestra el formulario de creación de un nuevo taller al pulsa el botón correspondiente.
     */
    public function testMuestraFormularioCrearTaller(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones')
                ->click('@botonCrearUbicacion')
                ->assertPathIs('/ubicaciones/create')
                ->assertSee('Nombre')
                ->assertSee('Descripción')
                ->assertSee('Días en los que está disponible:')
                ->assertSee('Crear nueva ubicación');
        });
    }

    /**
     * Comprueba que se muestran errores al intentar crear una ubicación con nombre,descripcion y días vacíos.
     */
    public function testMuestraErroresNombreDescripcionDiasVacios(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ubicaciones/create')
                ->press('Crear nueva ubicación')
                ->assertSee('El campo nombre es obligatorio')
                ->assertSee('El campo descripcion es obligatorio')
                ->assertSee('El campo dias es obligatorio');
        });
    }
}
