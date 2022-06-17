<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $courses = Skill::all();

        return view('course.index', compact('courses'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('course.create');
    }

    /**
     * @param \App\Http\Requests\CourseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        $course = Skill::create($request->validated());

        $request->session()->flash('course.id', $course->id);

        return redirect()->route('course.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Skill $course
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Skill $course)
    {
        return view('course.show', compact('course'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Skill $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Skill $course)
    {
        return view('course.edit', compact('course'));
    }

    /**
     * @param \App\Http\Requests\CourseUpdateRequest $request
     * @param \App\Models\Skill $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseUpdateRequest $request, Skill $course)
    {
        $course->update($request->validated());

        $request->session()->flash('course.id', $course->id);

        return redirect()->route('course.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Skill $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Skill $course)
    {
        $course->delete();

        return redirect()->route('course.index');
    }
}
