<?php

namespace App\Http\Livewire\Client;

use App\Enums\ReservationStatus;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Reservation;
use App\Notifications\ReservationMadeNotification;
use App\States\Booking\Pending;
use Livewire\Component;

class ProcessCheckout extends Component
{
    public $appointment;
    public $client;
    public $method;

    public function mount(Appointment $appointment, Client $client)
    {
        $this->client = $client;
        $this->appointment = $appointment->load('resource');
    }

    public function getClientAppointmentProperty()
    {
        return $this->appointment->clients()->where('client_id', $this->client->id)->first();
    }

    public function getTotalProperty()
    {
        return $this->clientAppointment->pivot->no_of_seats * $this->appointment->price;
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

    public function reservation()
    {
        $booking = Booking::create([
            'client_id' => $this->client->id,
            'appointment_id' => $this->appointment->id,
            'status' => Pending::class,
            'reference_code' => 'NL-B' . rand(0000000, 9999999),
            'booked_at' => now()
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'reference_code' => 'NL-P' . rand(0000000, 9999999),
            'status' => \App\States\Payment\Pending::class,
            'total_amount' => $this->total,
            'due_amount' => 0,
            'paid_amount' => 0,
        ]);

        for ($i = 1; $i <= $this->clientAppointment->pivot->no_of_seats; $i++) {
            Reservation::create([
                'client_id' => $this->client->id,
                'appointment_id' => $this->appointment->id,
                'booking_id' => $booking->id,
                'seat_number' => rand(1, $this->appointment->resource->capacity),
                'status' => ReservationStatus::INCOMPLETE,
                'reference_code' => 'NL-R' . rand(0000000, 9999999),
                'reserved_at' => now()
            ]);
        }

        $this->client->notify(new ReservationMadeNotification($this->getClientAppointmentProperty(), $booking, $payment));
    }

    public function render()
    {
        return view('livewire.client.process-checkout');
    }
}
