<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Timetable;
use App\States\Reservation\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status' => ReservationStatus::class,
            'reference_code' => $this->faker->word,
            'reserved_at' => $this->faker->dateTime(),
        ];
    }
}
