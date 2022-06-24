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
use Illuminate\Support\Facades\Storage;

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
            $skill = Skill::create($request->only(['title', 'slug', 'category_id', 'description', 'status']));

            $this->storeCoverPhoto($request, $skill);

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
        return view('admin.skill.show', [
            'skill' => $skill,
            'appointments' => $skill->appointments
        ]);
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

            if ($request->has('skill_cover_photo')) {
                if (isset($skill->image_path)) {
                    Storage::delete($skill->image_path);
                }

                $this->storeCoverPhoto($request, $skill);
            }

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

    protected function storeCoverPhoto($request, $skill)
    {
        $path = $request->file('skill_cover_photo')->storeAs(
            'skill_covers',
            $request->file('skill_cover_photo')->getClientOriginalName()
        );

        $skill->image_path = $path;
        $skill->save();
    }
}
