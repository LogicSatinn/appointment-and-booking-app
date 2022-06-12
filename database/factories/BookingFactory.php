<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Course;

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
            'course_id' => Course::factory(),
            'status' => $this->faker->word,
            'reference_code' => $this->faker->word,
            'booked_at' => $this->faker->dateTime(),
        ];
    }
}
