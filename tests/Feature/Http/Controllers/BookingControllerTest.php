<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BookingController
 */
class BookingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bookings = Booking::factory()->count(3)->create();

        $response = $this->get(route('booking.index'));

        $response->assertOk();
        $response->assertViewIs('booking.index');
        $response->assertViewHas('bookings');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('booking.create'));

        $response->assertOk();
        $response->assertViewIs('booking.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BookingController::class,
            'store',
            \App\Http\Requests\BookingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $client = Client::factory()->create();
        $course = Course::factory()->create();
        $status = $this->faker->word;
        $reference_code = $this->faker->word;
        $booked_at = $this->faker->dateTime();

        $response = $this->post(route('booking.store'), [
            'client_id' => $client->id,
            'course_id' => $course->id,
            'status' => $status,
            'reference_code' => $reference_code,
            'booked_at' => $booked_at,
        ]);

        $bookings = Booking::query()
            ->where('client_id', $client->id)
            ->where('course_id', $course->id)
            ->where('status', $status)
            ->where('reference_code', $reference_code)
            ->where('booked_at', $booked_at)
            ->get();
        $this->assertCount(1, $bookings);
        $booking = $bookings->first();

        $response->assertRedirect(route('booking.index'));
        $response->assertSessionHas('booking.id', $booking->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('booking.show', $booking));

        $response->assertOk();
        $response->assertViewIs('booking.show');
        $response->assertViewHas('booking');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('booking.edit', $booking));

        $response->assertOk();
        $response->assertViewIs('booking.edit');
        $response->assertViewHas('booking');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BookingController::class,
            'update',
            \App\Http\Requests\BookingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $booking = Booking::factory()->create();
        $client = Client::factory()->create();
        $course = Course::factory()->create();
        $status = $this->faker->word;
        $reference_code = $this->faker->word;
        $booked_at = $this->faker->dateTime();

        $response = $this->put(route('booking.update', $booking), [
            'client_id' => $client->id,
            'course_id' => $course->id,
            'status' => $status,
            'reference_code' => $reference_code,
            'booked_at' => $booked_at,
        ]);

        $booking->refresh();

        $response->assertRedirect(route('booking.index'));
        $response->assertSessionHas('booking.id', $booking->id);

        $this->assertEquals($client->id, $booking->client_id);
        $this->assertEquals($course->id, $booking->course_id);
        $this->assertEquals($status, $booking->status);
        $this->assertEquals($reference_code, $booking->reference_code);
        $this->assertEquals($booked_at, $booking->booked_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $booking = Booking::factory()->create();

        $response = $this->delete(route('booking.destroy', $booking));

        $response->assertRedirect(route('booking.index'));

        $this->assertSoftDeleted($booking);
    }
}
