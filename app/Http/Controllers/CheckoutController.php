<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * @param Timetable $timetable
     * @param Client $client
     * @return Application|Factory|View
     */
    public function index(Timetable $timetable, Client $client)
    {
        return view('client.checkout', [
            'timetable' => $timetable->load('skill'),
            'client' => $client,
            'clientTimetable' => $timetable->clients()->where('client_id', $client->id)->first()
        ]);
    }
}
