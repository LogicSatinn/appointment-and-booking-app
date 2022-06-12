<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ResourceController
 */
class ResourceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $resources = Resource::factory()->count(3)->create();

        $response = $this->get(route('resource.index'));

        $response->assertOk();
        $response->assertViewIs('resource.index');
        $response->assertViewHas('resources');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('resource.create'));

        $response->assertOk();
        $response->assertViewIs('resource.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ResourceController::class,
            'store',
            \App\Http\Requests\ResourceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $no_of_seats = $this->faker->numberBetween(-10000, 10000);
        $available = $this->faker->boolean;

        $response = $this->post(route('resource.store'), [
            'name' => $name,
            'no_of_seats' => $no_of_seats,
            'available' => $available,
        ]);

        $resources = Resource::query()
            ->where('name', $name)
            ->where('no_of_seats', $no_of_seats)
            ->where('available', $available)
            ->get();
        $this->assertCount(1, $resources);
        $resource = $resources->first();

        $response->assertRedirect(route('resource.index'));
        $response->assertSessionHas('resource.id', $resource->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $resource = Resource::factory()->create();

        $response = $this->get(route('resource.show', $resource));

        $response->assertOk();
        $response->assertViewIs('resource.show');
        $response->assertViewHas('resource');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $resource = Resource::factory()->create();

        $response = $this->get(route('resource.edit', $resource));

        $response->assertOk();
        $response->assertViewIs('resource.edit');
        $response->assertViewHas('resource');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ResourceController::class,
            'update',
            \App\Http\Requests\ResourceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $resource = Resource::factory()->create();
        $name = $this->faker->name;
        $no_of_seats = $this->faker->numberBetween(-10000, 10000);
        $available = $this->faker->boolean;

        $response = $this->put(route('resource.update', $resource), [
            'name' => $name,
            'no_of_seats' => $no_of_seats,
            'available' => $available,
        ]);

        $resource->refresh();

        $response->assertRedirect(route('resource.index'));
        $response->assertSessionHas('resource.id', $resource->id);

        $this->assertEquals($name, $resource->name);
        $this->assertEquals($no_of_seats, $resource->no_of_seats);
        $this->assertEquals($available, $resource->available);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $resource = Resource::factory()->create();

        $response = $this->delete(route('resource.destroy', $resource));

        $response->assertRedirect(route('resource.index'));

        $this->assertSoftDeleted($resource);
    }
}
