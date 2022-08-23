<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Timetable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    /**
     * @param  Timetable  $timetable
     * @param  Client  $client
     * @return Application|Factory|View
     */
    public function index(Reservation $reservation, Timetable $timetable, Client $client): View|Factory|Application
    {
        return view('client.checkout', [
            'reservation' => $reservation,
            'timetable' => $timetable->load('skill'),
            'client' => $client,
        ]);
    }

    /**
     * @param  Booking  $booking
     * @param  Timetable  $timetable
     * @param  Client  $client
     * @return Application|Factory|View
     */
    public function reservationComplete(Booking $booking, Timetable $timetable, Client $client): View|Factory|Application
    {
        return view('client.checkout-completed', [
            'booking' => $booking->load('payments', 'reservation'),
            'timetable' => $timetable,
            'client' => $client
        ]);
    }
}
