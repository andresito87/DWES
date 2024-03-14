<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UbicacionTest extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * A Dusk test example.
     */
    public function testMuestraPantallaBienvenida(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Bienvenido a la asociación Respira');
        });
    }
}
