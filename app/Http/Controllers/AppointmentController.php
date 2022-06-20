<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Models\Resource;
use App\Models\Skill;
use Error;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $appointments = Appointment::all();

        return view('admin.appointment.index', compact('appointments'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.appointment.create', [
            'skills' => Skill::pluck('title', 'id'),
            'resources' => Resource::pluck('name', 'id')
        ]);
    }

    /**
     * @param AppointmentStoreRequest $request
     * @return RedirectResponse
     */
    public function store(AppointmentStoreRequest $request)
    {
        try {
            Appointment::create($request->validated());

            toast('Appointment saved successfully.', 'success');

            return redirect()->route('appointments.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. We\re working hard to fix this.', 'error');

            return back();
        }

    }

    /**
     * @param Appointment $appointment
     * @return Application|Factory|View
     */
    public function show(Appointment $appointment)
    {
        return view('admin.appointment.show', compact('appointment'));
    }

    /**
     * @param Appointment $appointment
     * @return Application|Factory|View
     */
    public function edit(Appointment $appointment)
    {
        return view('admin.appointment.edit', [
            'appointment' => $appointment,
            'skills' => Skill::pluck('title', 'id'),
            'resources' => Resource::pluck('name', 'id')
        ]);
    }

    /**
     * @param AppointmentUpdateRequest $request
     * @param Appointment $appointment
     * @return RedirectResponse
     */
    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        try {
            $appointment->update($request->validated());

            toast('Appointment updated successfully', 'success');

            return redirect()->route('appointments.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. We\'re working on this right now', 'success');

            return back();
        }

    }

    /**
     * @param Appointment $appointment
     * @return RedirectResponse
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();

            toast('Appointment deleted successfully', 'success');

            return redirect()->route('appointments.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. We\re working hard to fix this.', 'error');

            return back();
        }

    }
}
