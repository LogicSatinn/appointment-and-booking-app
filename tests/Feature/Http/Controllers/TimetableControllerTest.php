<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\TimetableController;
use App\Http\Requests\TimetableStoreRequest;
use App\Http\Requests\TimetableUpdateRequest;
use App\Models\Timetable;
use App\Models\Skill;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TimetableController
 */
class TimetableControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $timetables = Timetable::factory()->count(3)->create();

        $response = $this->get(route('timetables.index'));

        $response->assertOk();
        $response->assertViewIs('timetable.index');
        $response->assertViewHas('timetables');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('timetables.create'));

        $response->assertOk();
        $response->assertViewIs('timetable.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            TimetableController::class,
            'store',
            TimetableStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $slug = $title;
        $from = $this->faker->date();
        $to = $this->faker->date();
        $start = $this->faker->time;
        $end = $this->faker->time;
        $status = $this->faker->randomElement([
            'NotStarted',
            'Available'
        ]);
        $price = rand(10000, 10000);
        $resource = Resource::factory()->create();
        $skill = Skill::factory()->create();

        $response = $this->post(route('timetables.store'), [
            'title' => $title,
            'slug' => $slug,
            'from' => $from,
            'to' => $to,
            'start' => $start,
            'end' => $end,
            'status' => $status,
            'price' => $price,
            'resource_id' => $resource->id,
            'skill_id' => $skill->id,
        ]);

        $timetables = Timetable::query()
            ->where('title', $title)
            ->where('slug', $slug)
            ->where('from', $from)
            ->where('to', $to)
            ->where('start', $start)
            ->where('end', $end)
            ->where('status', $status)
            ->where('price', $price)
            ->where('resource_id', $resource->id)
            ->where('skill_id', $skill->id)
            ->get();
        $this->assertCount(1, $timetables);
        $timetable = $timetables->first();

        $response->assertRedirect(route('timetables.index'));
        $response->assertSessionHas('timetable.id', $timetable->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $timetable = Timetable::factory()->create();

        $response = $this->get(route('timetables.show', $timetable));

        $response->assertOk();
        $response->assertViewIs('timetable.show');
        $response->assertViewHas('timetable');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $timetable = Timetable::factory()->create();

        $response = $this->get(route('timetables.edit', $timetable));

        $response->assertOk();
        $response->assertViewIs('timetable.edit');
        $response->assertViewHas('timetable');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            TimetableController::class,
            'update',
            TimetableUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $timetable = Timetable::factory()->create();
        $title = $this->faker->sentence(4);
        $slug = $title;
        $from = $this->faker->date();
        $to = $this->faker->date();
        $start = $this->faker->time;
        $end = $this->faker->time;
        $status = $this->faker->randomElement([
            'NotStarted',
            'Available'
        ]);
        $price = rand(10000, 10000);
        $resource = Resource::factory()->create();
        $skill = Skill::factory()->create();

        $response = $this->put(route('timetables.update', $timetable), [
            'title' => $title,
            'slug' => $slug,
            'from' => $from,
            'to' => $to,
            'start' => $start,
            'end' => $end,
            'status' => $status,
            'price' => $price,
            'resource_id' => $resource->id,
            'skill_id' => $skill->id,
        ]);

        $timetable->refresh();

        $response->assertRedirect(route('timetables.index'));
        $response->assertSessionHas('timetable.id', $timetable->id);

        $this->assertEquals($title, $timetable->title);
        $this->assertEquals($slug, $timetable->slug);
        $this->assertEquals($from, $timetable->from);
        $this->assertEquals($to, $timetable->to);
        $this->assertEquals($start, $timetable->start);
        $this->assertEquals($end, $timetable->end);
        $this->assertEquals($status, $timetable->status);
        $this->assertEquals($price, $timetable->price);
        $this->assertEquals($resource->id, $timetable->resource_id);
        $this->assertEquals($skill->id, $timetable->skill_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $timetable = Timetable::factory()->create();

        $response = $this->delete(route('timetables.destroy', $timetable));

        $response->assertRedirect(route('timetables.index'));

        $this->assertSoftDeleted($timetable);
    }
}
