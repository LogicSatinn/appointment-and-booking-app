<?php

namespace App\Jobs;

use App\Models\Client;
use App\Models\Timetable;
use App\Notifications\TimetableCancelled;
use Emanate\BeemSms\Facades\BeemSms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class DispatchNotificationsUponTimetableDeletion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Timetable $timetable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clients = Client::query()->whereHas('reservations.timetable', function ($query) {
            $query->where('id', $this->timetable->id);
        })->get();

        BeemSms::loadRecipients(collection: $clients)
            ->content('We are terribly sorry to announce that the timetable is cancelled until further notice.')
            ->send();

        Notification::send($clients, new TimetableCancelled($this->timetable));
    }
}
