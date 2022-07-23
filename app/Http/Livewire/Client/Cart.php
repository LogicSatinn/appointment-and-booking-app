<?php

namespace App\Http\Livewire\Client;

use App\Models\Timetable;
use App\Models\Client;
use App\View\Components\Client\MasterLayout;
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
        $this->seat += 1;
        $this->updateSubTotal();
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

    public function saveCart()
    {
        $this->timetable->clients()->attach($this->client->id, ['no_of_seats' => $this->seat]);

        return redirect(route('client.checkout', [
            'timetable' => $this->timetable,
            'client' => $this->client
        ]));
    }

    public function render()
    {
        return view('livewire.client.cart')
            ->layout(MasterLayout::class);
    }
}
