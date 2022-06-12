<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Appointment;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AppointmentController
 */
class AppointmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $appointments = Appointment::factory()->count(3)->create();

        $response = $this->get(route('appointment.index'));

        $response->assertOk();
        $response->assertViewIs('appointment.index');
        $response->assertViewHas('appointments');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('appointment.create'));

        $response->assertOk();
        $response->assertViewIs('appointment.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AppointmentController::class,
            'store',
            \App\Http\Requests\AppointmentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $duration = $this->faker->time();
        $appointment_time = $this->faker->dateTime();
        $resource = Resource::factory()->create();
        $course = Course::factory()->create();

        $response = $this->post(route('appointment.store'), [
            'title' => $title,
            'duration' => $duration,
            'appointment_time' => $appointment_time,
            'resource_id' => $resource->id,
            'course_id' => $course->id,
        ]);

        $appointments = Appointment::query()
            ->where('title', $title)
            ->where('duration', $duration)
            ->where('appointment_time', $appointment_time)
            ->where('resource_id', $resource->id)
            ->where('course_id', $course->id)
            ->get();
        $this->assertCount(1, $appointments);
        $appointment = $appointments->first();

        $response->assertRedirect(route('appointment.index'));
        $response->assertSessionHas('appointment.id', $appointment->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $appointment = Appointment::factory()->create();

        $response = $this->get(route('appointment.show', $appointment));

        $response->assertOk();
        $response->assertViewIs('appointment.show');
        $response->assertViewHas('appointment');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $appointment = Appointment::factory()->create();

        $response = $this->get(route('appointment.edit', $appointment));

        $response->assertOk();
        $response->assertViewIs('appointment.edit');
        $response->assertViewHas('appointment');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AppointmentController::class,
            'update',
            \App\Http\Requests\AppointmentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $appointment = Appointment::factory()->create();
        $title = $this->faker->sentence(4);
        $duration = $this->faker->time();
        $appointment_time = $this->faker->dateTime();
        $resource = Resource::factory()->create();
        $course = Course::factory()->create();

        $response = $this->put(route('appointment.update', $appointment), [
            'title' => $title,
            'duration' => $duration,
            'appointment_time' => $appointment_time,
            'resource_id' => $resource->id,
            'course_id' => $course->id,
        ]);

        $appointment->refresh();

        $response->assertRedirect(route('appointment.index'));
        $response->assertSessionHas('appointment.id', $appointment->id);

        $this->assertEquals($title, $appointment->title);
        $this->assertEquals($duration, $appointment->duration);
        $this->assertEquals($appointment_time, $appointment->appointment_time);
        $this->assertEquals($resource->id, $appointment->resource_id);
        $this->assertEquals($course->id, $appointment->course_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $appointment = Appointment::factory()->create();

        $response = $this->delete(route('appointment.destroy', $appointment));

        $response->assertRedirect(route('appointment.index'));

        $this->assertSoftDeleted($appointment);
    }
}
