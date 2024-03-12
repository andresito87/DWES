<?php

namespace Tests\Unit;

use App\Models\Taller;
use Tests\TestCase;

class TallerUnitTest extends TestCase
{
    public function test_asegurar_que_se_puede_crear_taller()
    {
        $taller = Taller::factory()->make();
        $this->assertInstanceOf(Taller::class, $taller);
    }
}
