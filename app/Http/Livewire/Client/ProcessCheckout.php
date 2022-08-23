<?php

namespace App\Http\Livewire\Client;

use App\Enums\BookingMethod;
use App\Jobs\ProcessNotificationsJob;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Timetable;
use App\States\Booking\Pending;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class ProcessCheckout extends Component
{
    public $reservation;

    public $timetable;

    public $client;

    public $method;

    public function mount(Reservation $reservation, Timetable $timetable, Client $client)
    {
        $this->reservation = $reservation;
        $this->client = $client;
        $this->timetable = $timetable->load('resource');
    }


    public function getTotalProperty(): float|int
    {
        return $this->reservation->no_of_seats * $this->timetable->price;
    }

    public function processCheckout(): void
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

    public function reservation(): Redirector|Application|RedirectResponse
    {
        $this->reservation->booking->update([
            'booking_method' => BookingMethod::RESERVATION,
        ]);

        ProcessNotificationsJob::dispatch($this->reservation, $this->reservation->booking, $this->client);

        return redirect(route('reservation-complete', [
            'booking' => $this->reservation->booking,
            'client' => $this->client,
            'timetable' => $this->timetable,
        ]));
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.client.process-checkout');
    }
}
