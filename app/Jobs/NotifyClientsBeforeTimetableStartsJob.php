<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\Timetable;
use App\Notifications\NotifyClientBeforeTimetableStartsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifyClientsBeforeTimetableStartsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle()
    {
        $timetables = Timetable::with(['reservations.client'])
            ->whereBetween('from', [now(), now()->addDays(2)])
            ->get();

        foreach ($timetables as $timetable) {
            if ($timetable->reservations()->count() > 0) {
                foreach ($timetable->reservations as $reservation) {
                    Notification::route('mail', $reservation->client->email)
                        ->notify(
                            new NotifyClientBeforeTimetableStartsNotification(
                                reservation_reference_code: $reservation->reference_code,
                                booking_reference_code: Booking::where('reservation_id', $reservation->id)->where('client_id', $reservation->client_id)->first()->reference_code,
                                title: $timetable->title
                            ));
                }
            }
        }
    }
}
