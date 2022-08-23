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
    public $timetable;

    public $client;

    public int $seat = 1;

    public int $subTotal;

    public int $discount = 0;

    public int $total;

    public function mount(Timetable $timetable, Client $client)
    {
        $this->timetable = $timetable->load('resource');
        $this->client = $client;
        $this->subTotal = $this->seat * $timetable->price;
        $this->total = $this->subTotal;
    }

    public function addSeat()
    {
        if (
            $this->timetable->resource->capacity > Reservation::whereTimetableId($this->timetable->id)->sum('no_of_seats')
        ) {
            $this->seat += 1;
            $this->updateSubTotal();
        }
        // TODO Add Notification that capacity is full

        return;
    }

    public function subtractSeat()
    {
        $this->seat -= 1;
        $this->updateSubTotal();
    }

    public function updateSubTotal()
    {
        $this->subTotal = $this->seat * $this->timetable->price;
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total = $this->subTotal - $this->discount;
    }

    public function saveCart(): Redirector|Application|RedirectResponse
    {
        $reservation = Reservation::create([
            'client_id' => $this->client->id,
            'timetable_id' => $this->timetable->id,
            'no_of_seats' => $this->seat,
            'reserved_at' => now(),
        ]);

        Cache::put($this->client->phone_number. '_' . $this->timetable->id, $this->seat, 432000);

        return redirect(route('client.checkout', [
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
