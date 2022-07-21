<?php

namespace App\Http\Livewire\Client;

use App\Models\Appointment;
use App\Models\Client;
use App\View\Components\Client\MasterLayout;
use Livewire\Component;

class EnrollClient extends Component
{
    public $appointment;
    public $name = 'Name';
    public $email = 'Email';
    public $phoneNumber = 'Phone Number';
    public $profession = null;
    public $address = null;
    public $client;

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|string|email',
        'phoneNumber' => 'required|string',
        'profession' => 'nullable|string|min:3',
        'address' => 'nullable|string|min:3'
    ];

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function saveClient()
    {
        $this->client = Client::firstOrCreate([
            'email' => $this->email,
            'phone_number' => $this->phoneNumber
        ],
        [
            'name' => $this->name,
            'profession' => $this->profession,
            'address' => $this->address
        ]);

        return redirect(route('cart', [
            'appointment' => $this->appointment,
            'client' => $this->client
        ]));
    }

    public function render()
    {
        return view('livewire.client.enroll-client')
            ->layout(MasterLayout::class);
    }
}
