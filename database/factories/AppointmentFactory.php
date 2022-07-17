<?php

namespace Database\Factories;

use App\States\Resource\Available;
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
        $sentence = $this->faker->sentence(4);
        return [
            'title' => $sentence,
            'slug' => $sentence,
            'from' => $this->faker->date(),
            'to' => $this->faker->date(),
            'start' => $this->faker->time,
            'end' => $this->faker->time,
            'status' => $this->faker->randomElement([
                'Pending',
                'Available'
            ]),
            'price' => rand(10000, 10000),
            'resource_id' => Resource::factory()->state([
                'state' => Available::class
            ]),
            'skill_id' => Skill::factory(),
        ];
    }
}
