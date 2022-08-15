<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\Timetable;
use App\Services\BeemSmsService;
use App\View\Components\Client\MasterLayout;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class EnrollClient extends Component
{
    public $timetable;

    public $name = 'Name';

    public $email = 'Email';

    public $phoneNumber = 'Phone Number';

    public $profession = null;

    public $address = null;

    public $client;

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|string|email',
        'phoneNumber' => 'required|string|starts_with:255|unique:clients,phone_number',
        'profession' => 'nullable|string|min:3',
        'address' => 'nullable|string|min:3',
    ];

    public function mount(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * @throws GuzzleException
     */
    public function saveClient(): Redirector|Application|RedirectResponse
    {
        $validatedData = $this->validate();

        try {
            $this->client = Client::firstOrCreate([
                'email' => $this->email,
                'phone_number' => $this->phoneNumber,
            ], [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phoneNumber'],
                'profession' => $validatedData['profession'],
                'address' => $validatedData['address'],
            ]);

            (new BeemSmsService())
                ->content('Your enrollment process is successful. Please continue with the booking and reservation processes.')
                ->getRecipients([$this->client->phone_number])->send();

            return redirect(route('cart', [
                'timetable' => $this->timetable,
                'client' => $this->client,
            ]));
        } catch (\Exception|\Error $e) {
            toast($e->getMessage().'Please try again later.', 'error');

            return back();
        }
    }

    public function render()
    {
        return view('livewire.client.enroll-client')
            ->layout(MasterLayout::class);
    }
}
