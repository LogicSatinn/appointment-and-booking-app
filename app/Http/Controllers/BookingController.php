<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = Booking::all();

        return view('booking.index', compact('bookings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('booking.create');
    }

    /**
     * @param \App\Http\Requests\BookingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $booking = Booking::create($request->validated());

        $request->session()->flash('booking.id', $booking->id);

        return redirect()->route('booking.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    /**
     * @param \App\Http\Requests\BookingUpdateRequest $request
     * @param \App\Models\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        $request->session()->flash('booking.id', $booking->id);

        return redirect()->route('booking.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Booking $booking)
    {
        $booking->delete();

        return redirect()->route('booking.index');
    }
}
