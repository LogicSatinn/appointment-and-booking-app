<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\ResourceController;
use App\Http\Requests\ResourceStoreRequest;
use App\Http\Requests\ResourceUpdateRequest;
use App\Models\Resource;
use App\States\Resource\Available;
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
            ResourceController::class,
            'store',
            ResourceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $slug = $name;
        $note = $this->faker->paragraph;
        $capacity = $this->faker->numberBetween(100, 900);
        $status = Available::class;

        $response = $this->post(route('resource.store'), [
            'name' => $name,
            'slug' => $slug,
            'note' => $note,
            'capacity' => $capacity,
            'status' => $status,
        ]);

        $resources = Resource::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('note', $note)
            ->where('capacity', $capacity)
            ->where('status', $status)
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
            ResourceController::class,
            'update',
            ResourceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $resource = Resource::factory()->create();
        $name = $this->faker->name;
        $slug = $name;
        $note = $this->faker->paragraph;
        $capacity = $this->faker->numberBetween(100, 900);
        $status = Available::class;

        $response = $this->put(route('resource.update', $resource), [
            'name' => $name,
            'slug' => $slug,
            'note' => $note,
            'capacity' => $capacity,
            'status' => $status,
        ]);

        $resource->refresh();

        $response->assertRedirect(route('resource.index'));
        $response->assertSessionHas('resource.id', $resource->id);

        $this->assertEquals($name, $resource->name);
        $this->assertEquals($slug, $resource->slug);
        $this->assertEquals($note, $resource->note);
        $this->assertEquals($capacity, $resource->capacity);
        $this->assertEquals($status, $resource->status);
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
