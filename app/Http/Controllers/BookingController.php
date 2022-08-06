<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.booking.index', [
            'bookings' => Booking::with('client', 'reservations')->get(),
        ]);
    }

    /**
     * @param  Booking  $booking
     * @return RedirectResponse
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index');
    }
}
