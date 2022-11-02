<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use App\Models\Timetable;
use App\View\Components\Client\MasterLayout;
use Emanate\BeemSms\Facades\BeemSms;
use Error;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class EnrollClient extends Component
{
    public Timetable $timetable;

    public string $name = '';

    public string $email = '';

    public string $phoneNumber = '';

    public ?string $profession;

    public ?string $address;

    public Client $client;

    protected array $rules = [
        'name' => ['required', 'string', 'min:3'],
        'email' => ['required', 'string', 'email'],
        'phoneNumber' => ['required', 'string', 'starts_with:255'],
        'profession' => ['nullable', 'string', 'min:3'],
        'address' => ['nullable', 'string', 'min:3'],
    ];

    public function mount(Timetable $timetable): void
    {
        $this->timetable = $timetable;
    }

    public function saveClient(): void
    {
        $validatedData = $this->validate();

        try {
            $this->client = Client::firstOrCreate([
                'email' => $this->email,
                'phone_number' => $this->phoneNumber,
            ], [
                'name' => $validatedData['name'],
                'profession' => $validatedData['profession'],
                'address' => $validatedData['address'],
            ]);

            if (App::environment('production')) {
                dispatch(function () {
                    BeemSms::content('Your enrollment process is successful. Please continue with the booking and reservation processes.')
                        ->getRecipients([$this->client->phone_number])
                        ->send();
                })->afterResponse();
            }

            toast('You have been successfully enrolled.', 'success');

            $this->redirect(route('cart', [
                'timetable' => $this->timetable,
                'client' => $this->client,
            ]));
        } catch (GuzzleException|Exception|Error $e) {
            toast($e->getMessage().'Please try again later.', 'error');

            $this->redirect(route('enroll-client', $this->timetable));
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.client.enroll-client')
            ->layout(MasterLayout::class);
    }
}
