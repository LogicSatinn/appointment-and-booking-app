<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorStoreRequest;
use App\Http\Requests\InstructorUpdateRequest;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $instructors = Instructor::all();

        return view('instructor.index', compact('instructors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('instructor.create');
    }

    /**
     * @param \App\Http\Requests\InstructorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructorStoreRequest $request)
    {
        $instructor = Instructor::create($request->validated());

        $request->session()->flash('instructor.id', $instructor->id);

        return redirect()->route('instructor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Instructor $instructor)
    {
        return view('instructor.show', compact('instructor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Instructor $instructor)
    {
        return view('instructor.edit', compact('instructor'));
    }

    /**
     * @param \App\Http\Requests\InstructorUpdateRequest $request
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(InstructorUpdateRequest $request, Instructor $instructor)
    {
        $instructor->update($request->validated());

        $request->session()->flash('instructor.id', $instructor->id);

        return redirect()->route('instructor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('instructor.index');
    }
}
