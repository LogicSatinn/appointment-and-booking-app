<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimetableStoreRequest;
use App\Http\Requests\TimetableUpdateRequest;
use App\Models\Timetable;
use App\Models\Resource;
use App\Models\Skill;
use Error;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TimetableController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $timetables = Timetable::all();

        return view('admin.timetable.index', compact('timetables'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.timetable.create', [
            'skills' => Skill::pluck('title', 'id'),
            'resources' => Resource::pluck('name', 'id')
        ]);
    }

    /**
     * @param TimetableStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TimetableStoreRequest $request)
    {
        try {
            Timetable::create($request->validated());

            toast('Timetable saved successfully.', 'success');

            return redirect()->route('timetables.index');
        } catch (Exception|Error $e) {
            toast('Something went really wrong. We\'re working hard to fix this.', 'error');

            Log::debug('TimetableController::store => ' . $e);

            return back();
        }
    }

    /**
     * @param Timetable $timetable
     * @return Application|Factory|View
     */
    public function show(Timetable $timetable)
    {
        return view('admin.timetable.show', [
            'timetable' => $timetable->load('clients', 'bookings.reservations', 'resource')
        ]);
    }

    /**
     * @param Timetable $timetable
     * @return Application|Factory|View
     */
    public function edit(Timetable $timetable)
    {
        return view('admin.timetable.edit', [
            'timetable' => $timetable,
            'skills' => Skill::pluck('title', 'id'),
            'resources' => Resource::pluck('name', 'id')
        ]);
    }

    /**
     * @param TimetableUpdateRequest $request
     * @param Timetable $timetable
     * @return RedirectResponse
     */
    public function update(TimetableUpdateRequest $request, Timetable $timetable)
    {
        try {
            $timetable->update($request->validated());

            toast('Timetable updated successfully', 'success');

            return redirect()->route('timetables.index');
        } catch (Exception|Error $e) {
            toast('Something went really wrong. We\'re working on this right now', 'error');

            Log::debug('TimetableController::update => ' . $e);

            return back();
        }
    }

    /**
     * @param Timetable $timetable
     * @return RedirectResponse
     */
    public function destroy(Timetable $timetable)
    {
        try {
            $timetable->delete();

            toast('Timetable deleted successfully', 'success');

            return redirect()->route('timetables.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. We\re working hard to fix this.', 'error');

            return back();
        }

    }
}
