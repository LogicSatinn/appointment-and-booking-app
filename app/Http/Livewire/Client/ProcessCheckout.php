<?php

namespace App\Http\Livewire\Client;

use App\Enums\BookingMethod;
use App\Jobs\ProcessCheckoutPaymentJob;
use App\Jobs\ProcessNotificationsJob;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Timetable;
use App\States\Reservation\Reserved;
use Carbon\Carbon;
use Emanate\BeemSms\Facades\BeemSms;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ProcessCheckout extends Component
{
    public Reservation $reservation;

    public Timetable $timetable;

    public Client $client;

    public string $method = '';


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

    /**
     * @throws GuzzleException
     */
    public function processCheckout(): void
    {
        if ($this->method == 'Direct Payment') {
            $this->directPayment();
        }

        if ($this->method == 'Reservation') {
            $this->reservation();
        }
    }

    /**
     * @return void
     * @throws GuzzleException
     */
    public function directPayment(): void
    {
        $booking = Booking::create([
            'total_amount' => (float) $this->reservation->timetable->price * (int) $this->reservation->no_of_seats,
            'client_id' => $this->reservation->client_id,
            'timetable_id' => $this->reservation->timetable_id,
            'reservation_id' => $this->reservation->id,
            'booking_method' => BookingMethod::DIRECT_PAYMENT
        ]);

        ProcessCheckoutPaymentJob::dispatch($booking, $this->client);

        if (App::environment('production')) {
            dispatch(function () {
                BeemSms::content('You will receive a pop-up asking to finalize the transaction and we will notify you as soon as the transaction is confirmed. Thank you for doing business with us.')
                    ->getRecipients([$this->client->phone_number])
                    ->send();
            });
        }

        toast(
            title: 'You will receive a pop-up asking to finalize the transaction and we will notify you as soon as the transaction is confirmed. Thank you for doing business with us.',
            type: 'info',
            position: 'center'
        );

        $this->proceed();
    }

    public function reservation(): void
    {
        if (now() < Carbon::make($this->timetable->from)->subHours(30)) {
            $this->reservation->status->transitionTo(Reserved::class);

            Booking::create([
                'total_amount' => (float) $this->reservation->timetable->price * (int) $this->reservation->no_of_seats,
                'client_id' => $this->reservation->client_id,
                'timetable_id' => $this->reservation->timetable_id,
                'reservation_id' => $this->reservation->id,
                'booking_method' => BookingMethod::RESERVATION,
            ]);

            ProcessNotificationsJob::dispatch($this->reservation, $this->reservation->booking, $this->client);

            $this->proceed();
        }

        toast('Sorry!😢. You cannot reserve this timetable at the moment.', 'error');

        $this->redirect(route('client.checkout', [
            'reservation' => $this->reservation,
            'timetable' => $this->timetable,
            'client' => $this->client,
        ]));
    }

    public function proceed(): void
    {
        $this->redirect(route('reservation-complete', [
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
