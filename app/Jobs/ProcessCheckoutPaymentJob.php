<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Payment;
use App\Support\Helpers\PhoneNumberMnoGetter;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Shoket\Laravel\Facades\Shoket;

class ProcessCheckoutPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly Booking $booking,
        private readonly Client $client,
    )
    {
    }

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $data = [
            'amount' => str(intval($this->booking->total_amount)),
            'customer_name' => $this->client->name,
            'email' => $this->client->email,
            'number_used' => $this->client->phone_number,
            'channel' => (new PhoneNumberMnoGetter(phone_number: $this->client->phone_number))->getMno()
        ];

        $response = Shoket::makePaymentRequest(data: $data);

        Payment::create([
            'reference_code' => $response['reference'],
            'amount' => $this->booking->total_amount,
            'booking_id' => $this->booking->getKey(),
            'status' => $response['data']['payment_status'],
            'payment_method' => 'Mobile Money',
        ]);
    }
}
