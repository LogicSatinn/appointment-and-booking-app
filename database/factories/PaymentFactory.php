<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Payment;

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
            'paid_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'total_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'due_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'status' => $this->faker->word,
            'booking_id' => Booking::factory(),
            'reference_code' => $this->faker->word,
        ];
    }
}
