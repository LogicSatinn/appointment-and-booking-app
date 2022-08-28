<?php

namespace App\Jobs;

use App\Models\Timetable;
use App\States\Timetable\Complete;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\ModelStates\Exceptions\CouldNotPerformTransition;

class TimetableHasEndedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {}

    /**
     * @throws CouldNotPerformTransition
     */
    public function handle()
    {
        $timetables = Timetable::where('to', '<', today())
            ->get();

        foreach ($timetables as $timetable) {
            $timetable->status->transitionTo(Complete::class);
        }
    }
}
