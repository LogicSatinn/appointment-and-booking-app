<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reservation;
use App\Models\Skill;
use App\Models\Timetable;
use App\States\Skill\Published;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ClientSideController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('client.index', [
            'skills' => Skill::with('category:id,name')->whereState('status', Published::class)->get(),
            'categories' => Category::select('id', 'name')->withCount('skills')->get()->sortByDesc('skills_count'),
            'upcomingTimetables' => Timetable::whereRelation('skill', 'status', 'Published')
                ->whereBetween('from', [now(), now()->addWeek()])
                ->with(['skill' => function ($query) {
                    $query->whereState('status', Published::class);
                }])->orderBy('from')->get(),
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function skills()
    {
        return view('client.skills.skills', [
            'skills' => Skill::with('category:id,name')->whereState('status', Published::class)->get(),
        ]);
    }

    /**
     * @param  Skill  $skill
     * @return Application|Factory|View
     */
    public function skillDetails(Skill $skill)
    {
        return view('client.skills.skill-details', [
            'skill' => $skill,
            'timetables' => $skill->timetables,
        ]);
    }

    /**
     * @param  Timetable  $timetable
     * @return Application|Factory|View
     */
    public function timetableDetails(Timetable $timetable)
    {
        return view('client.timetable.timetable-details', [
            'timetable' => $timetable->load('skill.category', 'resource'),
            'noOfSeats' => Reservation::whereTimetableId($timetable->id)->sum('no_of_seats'),
            'otherTimetables' => Timetable::with('skill.category')->whereSkillId($timetable->skill->id)->whereNot('id', $timetable->id)->get(),
        ]);
    }
}
