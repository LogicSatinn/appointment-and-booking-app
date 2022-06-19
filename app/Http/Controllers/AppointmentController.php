<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
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

        return view('appointment.index', compact('appointments'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('appointment.create');
    }

    /**
     * @param AppointmentStoreRequest $request
     * @return RedirectResponse
     */
    public function store(AppointmentStoreRequest $request)
    {
        Appointment::create($request->validated());

        toast('Appointment saved successfully.', 'success');

        return redirect()->route('appointment.index');
    }

    /**
     * @param Appointment $appointment
     * @return Application|Factory|View
     */
    public function show(Appointment $appointment)
    {
        return view('appointment.show', compact('appointment'));
    }

    /**
     * @param Appointment $appointment
     * @return Application|Factory|View
     */
    public function edit(Appointment $appointment)
    {
        return view('appointment.edit', compact('appointment'));
    }

    /**
     * @param AppointmentUpdateRequest $request
     * @param Appointment $appointment
     * @return RedirectResponse
     */
    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        toast('Appointment updated successfully', 'success');

        return redirect()->route('appointment.index');
    }

    /**
     * @param Appointment $appointment
     * @return RedirectResponse
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointment.index');
    }
}
