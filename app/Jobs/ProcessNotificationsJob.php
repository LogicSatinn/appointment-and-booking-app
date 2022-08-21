<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use App\Notifications\ClientReservationMadeNotification;
use Emanate\BeemSms\Facades\BeemSms;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class ProcessNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Booking $booking;

    protected Client $client;

    protected Reservation $reservation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, Booking $booking, Client $client)
    {
        $this->reservation = $reservation->withoutRelations();
        $this->booking = $booking->withoutRelations();
        $this->client = $client->withoutRelations();
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $this->client->notify(new ClientReservationMadeNotification($this->reservation, $this->booking, $this->client));

        if (App::environment('production')) {
            BeemSms::content('Hello There. Your reservation has been secured. You will receive an email with further details.')
                ->loadRecipients($this->client)
                ->send();
        }
    }
}
