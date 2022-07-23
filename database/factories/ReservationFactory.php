<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Timetable;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'timetable_id' => Timetable::factory(),
            'booking_id' => Booking::factory(),
            'seat_number' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->word,
            'reference_code' => $this->faker->word,
            'reserved_at' => $this->faker->dateTime(),
        ];
    }
}
