<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * @param Appointment $appointment
     * @param Client $client
     * @return Application|Factory|View
     */
    public function index(Appointment $appointment, Client $client)
    {
        return view('client.checkout', [
            'appointment' => $appointment->load('skill'),
            'client' => $client,
            'clientAppointment' => $appointment->clients()->where('client_id', $client->id)->first()
        ]);
    }
}
