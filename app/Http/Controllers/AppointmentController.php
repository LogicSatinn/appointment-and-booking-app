<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $appointments = Appointment::all();

        return view('appointment.index', compact('appointments'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('appointment.create');
    }

    /**
     * @param \App\Http\Requests\AppointmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentStoreRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        $request->session()->flash('appointment.id', $appointment->id);

        return redirect()->route('appointment.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Appointment $appointment)
    {
        return view('appointment.show', compact('appointment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Appointment $appointment)
    {
        return view('appointment.edit', compact('appointment'));
    }

    /**
     * @param \App\Http\Requests\AppointmentUpdateRequest $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        $request->session()->flash('appointment.id', $appointment->id);

        return redirect()->route('appointment.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointment.index');
    }
}
