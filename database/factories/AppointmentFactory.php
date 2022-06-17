<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Appointment;
use App\Models\Skill;
use App\Models\Resource;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'duration' => $this->faker->time(),
            'appointment_time' => $this->faker->dateTime(),
            'resource_id' => Resource::factory(),
            'course_id' => Skill::factory(),
        ];
    }
}
