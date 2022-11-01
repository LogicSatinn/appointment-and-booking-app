<?php

namespace App\Jobs;

use App\Models\Timetable;
use App\States\Resource\Available;
use App\States\Resource\InSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\ModelStates\Exceptions\CouldNotPerformTransition;

class SwitchResourceAvailabilityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    /**
     * @throws CouldNotPerformTransition
     */
    public function handle(): void
    {
        $timetables = Timetable::with(['resource'])
            ->where('from', '<=', today())
            ->where('to', '>=', today())
            ->get();

        foreach ($timetables as $timetable) {
            if (
                $timetable->start <= now()->format('H:i') &&
                $timetable->end >= now()->format('H:i')
            ) {
                $timetable->resource->state->transitionTo(InSession::class);
            }

            if ($timetable->end < now()->format('H:i')) {
                $timetable->resource->state->transitionTo(Available::class);
            }
        }
    }
}
