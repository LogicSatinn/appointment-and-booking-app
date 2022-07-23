<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Timetable;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    /**
     * @param Timetable $timetable
     * @param Client $client
     * @return Application|Factory|View
     */
    public function index(Timetable $timetable, Client $client): View|Factory|Application
    {
        return view('client.checkout', [
            'timetable' => $timetable->load('skill'),
            'client' => $client,
            'clientTimetable' => $timetable->clients()->where('client_id', $client->id)->first()
        ]);
    }

    /**
     * @param Booking $booking
     * @param Timetable $timetable
     * @param Client $client
     * @return Application|Factory|View
     */
    public function reservationComplete(Booking $booking, Timetable $timetable, Client $client): View|Factory|Application
    {
        return view('client.checkout-completed', [
            'booking' => $booking->load('payments', 'reservations'),
            'clientTimetable' => $timetable->clients()->where('client_id', $client->id)->firstOrFail(),
            'timetable' => $timetable
        ]);
    }
}
