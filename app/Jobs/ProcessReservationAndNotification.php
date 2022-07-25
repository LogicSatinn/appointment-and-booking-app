<?php

namespace App\Jobs;

use App\Enums\ReservationStatus;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\ClientReservationMadeNotification;
use App\Notifications\NewReservationMadeNotification;
use App\Services\BeemSmsService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessReservationAndNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;
    protected $client;
    protected $timetable;
    protected $clientTimetable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($booking, $client, $timetable)
    {
        $this->booking = $booking;
        $this->client = $client;
        $this->timetable = $timetable;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->clientTimetable = $this->timetable->clients()->where('client_id', $this->client->id)->first();

        for ($i = 1; $i <= $this->clientTimetable->pivot_no_of_seats; $i++) {
            Reservation::create([
                'client_id' => $this->client->id,
                'timetable_id' => $this->timetable->id,
                'booking_id' => $this->booking->id,
                'seat_number' => rand(1, $this->timetable->resource->capacity),
                'status' => ReservationStatus::BOOKED,
                'reference_code' => 'NL-R' . rand(0000000, 9999999),
                'reserved_at' => now()
            ]);
        }

        $this->client->notify(new ClientReservationMadeNotification($this->clientTimetable, $this->booking));
        User::whereEmail('chaupele@hotmial.com')->firstOrFail()->notify(new NewReservationMadeNotification($this->timetable, $this->clientTimetable));
        (new BeemSmsService())->content('Hello There. Your reservation has been secured. You will receive an email with further details.')
            ->getRecipients([$this->client->phone_number])
            ->send();
    }
}
