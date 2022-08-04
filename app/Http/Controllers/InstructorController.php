<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorStoreRequest;
use App\Http\Requests\InstructorUpdateRequest;
use App\Models\Instructor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $instructors = Instructor::all();

        return view('admin.instructor.index', compact('instructors'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        return view('admin.instructor.create');
    }

    /**
     * @param InstructorStoreRequest $request
     * @return RedirectResponse
     */
    public function store(InstructorStoreRequest $request)
    {
        Instructor::create($request->validated());

        return redirect()->route('instructor.index');
    }

    /**
     * @param Request $request
     * @param Instructor $instructor
     * @return Application|Factory|View
     */
    public function show(Request $request, Instructor $instructor)
    {
        return view('admin.instructor.show', compact('instructor'));
    }

    /**
     * @param Request $request
     * @param Instructor $instructor
     * @return Application|Factory|View
     */
    public function edit(Request $request, Instructor $instructor)
    {
        return view('admin.instructor.edit', compact('instructor'));
    }

    /**
     * @param InstructorUpdateRequest $request
     * @param Instructor $instructor
     * @return RedirectResponse
     */
    public function update(InstructorUpdateRequest $request, Instructor $instructor)
    {
        $instructor->update($request->validated());

        return redirect()->route('instructor.index');
    }

    /**
     * @param Request $request
     * @param Instructor $instructor
     * @return RedirectResponse
     */
    public function destroy(Request $request, Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('instructor.index');
    }
}
