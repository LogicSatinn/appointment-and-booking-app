<?php

namespace App\Http\Controllers;

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
            'skills' => Skill::with('category')->get()
        ]);
    }

    /**
     * @param Skill $skill
     * @return Application|Factory|View
     */
    public function skillDetails(Skill $skill)
    {
        return view('client.skill-details', [
            'skill' => $skill
        ]);
    }
}
