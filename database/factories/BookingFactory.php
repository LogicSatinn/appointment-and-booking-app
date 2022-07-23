<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Skill;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'status' => $this->faker->word,
            'reference_code' => $this->faker->word,
            'booked_at' => $this->faker->dateTime(),
            'paid_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'total_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'due_amount' => $this->faker->randomFloat(2, 0, 999999.99),
        ];
    }
}
