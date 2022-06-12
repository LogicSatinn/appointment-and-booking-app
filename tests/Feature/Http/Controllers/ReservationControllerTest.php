<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReservationController
 */
class ReservationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $reservations = Reservation::factory()->count(3)->create();

        $response = $this->get(route('reservation.index'));

        $response->assertOk();
        $response->assertViewIs('reservation.index');
        $response->assertViewHas('reservations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('reservation.create'));

        $response->assertOk();
        $response->assertViewIs('reservation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'store',
            \App\Http\Requests\ReservationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $client = Client::factory()->create();
        $appointment = Appointment::factory()->create();
        $booking = Booking::factory()->create();
        $seat_number = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $reference_code = $this->faker->word;
        $reserved_at = $this->faker->dateTime();

        $response = $this->post(route('reservation.store'), [
            'client_id' => $client->id,
            'appointment_id' => $appointment->id,
            'booking_id' => $booking->id,
            'seat_number' => $seat_number,
            'status' => $status,
            'reference_code' => $reference_code,
            'reserved_at' => $reserved_at,
        ]);

        $reservations = Reservation::query()
            ->where('client_id', $client->id)
            ->where('appointment_id', $appointment->id)
            ->where('booking_id', $booking->id)
            ->where('seat_number', $seat_number)
            ->where('status', $status)
            ->where('reference_code', $reference_code)
            ->where('reserved_at', $reserved_at)
            ->get();
        $this->assertCount(1, $reservations);
        $reservation = $reservations->first();

        $response->assertRedirect(route('reservation.index'));
        $response->assertSessionHas('reservation.id', $reservation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservation.show', $reservation));

        $response->assertOk();
        $response->assertViewIs('reservation.show');
        $response->assertViewHas('reservation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservation.edit', $reservation));

        $response->assertOk();
        $response->assertViewIs('reservation.edit');
        $response->assertViewHas('reservation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationController::class,
            'update',
            \App\Http\Requests\ReservationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $reservation = Reservation::factory()->create();
        $client = Client::factory()->create();
        $appointment = Appointment::factory()->create();
        $booking = Booking::factory()->create();
        $seat_number = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $reference_code = $this->faker->word;
        $reserved_at = $this->faker->dateTime();

        $response = $this->put(route('reservation.update', $reservation), [
            'client_id' => $client->id,
            'appointment_id' => $appointment->id,
            'booking_id' => $booking->id,
            'seat_number' => $seat_number,
            'status' => $status,
            'reference_code' => $reference_code,
            'reserved_at' => $reserved_at,
        ]);

        $reservation->refresh();

        $response->assertRedirect(route('reservation.index'));
        $response->assertSessionHas('reservation.id', $reservation->id);

        $this->assertEquals($client->id, $reservation->client_id);
        $this->assertEquals($appointment->id, $reservation->appointment_id);
        $this->assertEquals($booking->id, $reservation->booking_id);
        $this->assertEquals($seat_number, $reservation->seat_number);
        $this->assertEquals($status, $reservation->status);
        $this->assertEquals($reference_code, $reservation->reference_code);
        $this->assertEquals($reserved_at, $reservation->reserved_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->delete(route('reservation.destroy', $reservation));

        $response->assertRedirect(route('reservation.index'));

        $this->assertSoftDeleted($reservation);
    }
}
