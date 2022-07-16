<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
            'skills' => Skill::with('category:id,name')->get(),
            'categories' => Category::select('id', 'name')->withCount('skills')->get()->sortByDesc('skills_count')
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
            'appointments' => $skill->appointments
        ]);
    }

    /**
     * @param Appointment $appointment
     * @return Application|Factory|View
     */
    public function appointmentDetails(Appointment $appointment)
    {
        return view('client.appointment-details', [
            'appointment' => $appointment->load('skill.category'),
            'otherAppointments' => Appointment::with('skill.category')->whereSkillId($appointment->skill->id)->whereNot('id', $appointment->id)->get()
        ]);
    }
}
