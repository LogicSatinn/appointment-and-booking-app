<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Timetable;
use App\View\Components\Client\MasterLayout;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Cart extends Component
{
    public Timetable $timetable;

    public Client $client;

    public int $noOfSeats = 1;

    public int $subTotal;

    public int $discount = 0;

    public int $total;

    public function mount(Timetable $timetable, Client $client): void
    {
        $this->timetable = $timetable->load('resource');
        $this->client = $client;
        $this->subTotal = $this->noOfSeats * $timetable->price;
        $this->total = $this->subTotal;
    }

    public function addSeat(): void
    {
        if (
            $this->timetable->resource->capacity > Reservation::whereTimetableId($this->timetable->id)->sum('no_of_seats')
        ) {
            $this->noOfSeats += 1;
            $this->updateSubTotal();
        }
        // TODO Add Notification that capacity is full

    }

    public function subtractSeat(): void
    {
        $this->noOfSeats -= 1;
        $this->updateSubTotal();
    }

    public function updateSubTotal(): void
    {
        $this->subTotal = $this->noOfSeats * $this->timetable->price;
        $this->updateTotal();
    }

    public function updateTotal(): void
    {
        $this->total = $this->subTotal - $this->discount;
    }

    public function saveCart(): void
    {
        $reservation = Reservation::create([
            'client_id' => $this->client->id,
            'timetable_id' => $this->timetable->id,
            'no_of_seats' => $this->noOfSeats,
            'reserved_at' => now(),
        ]);

        $this->redirect(route('client.checkout', [
            'reservation' => $reservation,
            'timetable' => $this->timetable,
            'client' => $this->client,
        ]));
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.client.cart')
            ->layout(MasterLayout::class);
    }
}
