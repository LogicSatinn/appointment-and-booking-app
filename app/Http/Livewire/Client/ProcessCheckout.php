<?php

namespace App\Http\Livewire\Client;

use App\Enums\BookingMethod;
use App\Enums\ReservationStatus;
use App\Jobs\ProcessReservationAndNotification;
use App\Models\Timetable;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\ClientReservationMadeNotification;
use App\Notifications\NewReservationMadeNotification;
use App\Services\BeemSmsService;
use App\States\Booking\Pending;
use GuzzleHttp\Exception\GuzzleException;
use Livewire\Component;

class ProcessCheckout extends Component
{
    public $timetable;
    public $client;
    public $method;

    public function mount(Timetable $timetable, Client $client)
    {
        $this->client = $client;
        $this->timetable = $timetable->load('resource');
    }

    public function getClientTimetableProperty()
    {
        return $this->timetable->clients()->where('client_id', $this->client->id)->first();
    }

    public function getTotalProperty()
    {
        return $this->clientTimetable->pivot->no_of_seats * $this->timetable->price;
    }

    public function processCheckout()
    {
        if ($this->method == 'Direct Payment') {
            $this->directPayment();
        }

        if ($this->method == 'Reservation') {
            $this->reservation();
        }
    }

    public function directPayment()
    {
        //
    }

    /**
     */
    public function reservation()
    {
        $booking = Booking::create([
            'client_id' => $this->client->id,
            'timetable_id' => $this->timetable->id,
            'status' => Pending::class,
            'reference_code' => 'NL-B' . rand(0000000, 9999999),
            'booked_at' => now(),
            'total_amount' => $this->total,
            'due_amount' => 0,
            'paid_amount' => 0,
            'booking_method' => BookingMethod::RESERVATION,
        ]);

        ProcessReservationAndNotification::dispatch($booking, $this->client, $this->timetable);

        return redirect(route('reservation-complete', [
            'booking' => $booking,
            'client' => $this->client,
            'timetable' => $this->timetable
        ]));
    }

    public function render()
    {
        return view('livewire.client.process-checkout');
    }
}
