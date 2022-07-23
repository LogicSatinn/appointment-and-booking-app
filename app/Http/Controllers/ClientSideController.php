<?php

namespace App\Http\Controllers;

use App\Enums\SkillStatus;
use App\Models\Timetable;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClientSideController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('client.index', [
            'skills' => Skill::with('category:id,name')->where('status', SkillStatus::PUBLISHED)->get(),
            'categories' => Category::select('id', 'name')->withCount('skills')->get()->sortByDesc('skills_count'),
            'upcomingTimetables' => Timetable::whereRelation('skill', 'status', SkillStatus::PUBLISHED)
                ->whereBetween('from', [now(), now()->addWeek()])
                ->with(['skill' => function ($query) {
                    $query->where('status', SkillStatus::PUBLISHED);
                }])->orderBy('from')->get()
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function skills()
    {
        return view('client.skills', [
            'skills' => Skill::with('category:id,name')->where('status', SkillStatus::PUBLISHED)->get()
        ]);
    }

    /**
     * @param Skill $skill
     * @return Application|Factory|View
     */
    public function skillDetails(Skill $skill)
    {
        return view('client.skill-details', [
            'skill' => $skill,
            'timetables' => $skill->timetables
        ]);
    }

    /**
     * @param Timetable $timetable
     * @return Application|Factory|View
     */
    public function timetableDetails(Timetable $timetable)
    {
        return view('client.timetable-details', [
            'timetable' => $timetable->load('skill.category'),
            'otherTimetables' => Timetable::with('skill.category')->whereSkillId($timetable->skill->id)->whereNot('id', $timetable->id)->get()
        ]);
    }
}