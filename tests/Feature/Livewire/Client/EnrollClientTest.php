<?php

namespace Tests\Feature\Livewire\CLient;

use App\Http\Livewire\CLient\EnrollClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
