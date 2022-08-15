<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_method' => $this->faker->word,
            'amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'status' => $this->faker->word,
            'booking_id' => Booking::factory(),
            'reference_code' => $this->faker->word,
        ];
    }
}
