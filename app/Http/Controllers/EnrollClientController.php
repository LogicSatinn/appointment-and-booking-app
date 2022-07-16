<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EnrollClientController extends Controller
{
    /**
     * @param Appointment $appointment
     * @param ClientStoreRequest $request
     * @return Application|Factory|View
     */
    public function enroll(Appointment $appointment, ClientStoreRequest $request)
    {
        Client::updateOrCreate($request->validated());

        return view('cart', [
            'appointment' => $appointment
        ]);
    }
}
