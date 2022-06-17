<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Models\Category;
use App\Models\Skill;
use Error;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $skills = Skill::all();

        return view('admin.skill.index', compact('skills'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.skill.create', [
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    /**
     * @param SkillStoreRequest $request
     * @return RedirectResponse
     */
    public function store(SkillStoreRequest $request)
    {
        try {
            Skill::create($request->validated());

            toast('Skill saved successfully', 'success');

            return redirect()->route('skills.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. Don\'t worry, we are working on it.', 'error');

            return back();
        }

    }

    /**
     * @param Skill $skill
     * @return Application|Factory|View
     */
    public function show(Skill $skill)
    {
        return view('admin.skill.show', compact('skill'));
    }

    /**
     * @param Skill $skill
     * @return Application|Factory|View
     */
    public function edit(Skill $skill)
    {
        return view('admin.skill.edit', [
            'skill' => $skill,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    /**
     * @param SkillUpdateRequest $request
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function update(SkillUpdateRequest $request, Skill $skill)
    {
        try {
            $skill->update($request->validated());

            toast('Skill updated successfully', 'success');

            return redirect()->route('skills.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. Don\'t worry, we are working on it.', 'error');

            return back();
        }

    }

    /**
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function destroy(Skill $skill)
    {
        try {
            $skill->delete();

            toast('Skill deleted successfully', 'success');

            return redirect()->route('skills.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. Don\'t worry, we are working on it.', 'error');

            return back();
        }

    }
}
