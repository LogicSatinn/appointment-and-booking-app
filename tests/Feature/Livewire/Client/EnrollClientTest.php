<?php

namespace Tests\Feature\Livewire\Client;

use App\Http\Livewire\CLient\EnrollClient;
use Livewire\Livewire;
use Tests\TestCase;

class EnrollClientTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(EnrollClient::class);

        $component->assertStatus(200);
    }
}
