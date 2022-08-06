<?php

namespace Database\Factories;

use App\Enums\SkillLevel;
use App\Models\Resource;
use App\Models\Skill;
use App\Models\Timetable;
use App\States\Resource\Available;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimetableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timetable::class;

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
                'NotStarted',
                'Available',
            ]),
            'price' => rand(10000, 10000),
            'resource_id' => Resource::factory()->state([
                'state' => Available::class,
            ]),
            'level' => $this->faker->randomElement([
                SkillLevel::BEGINNER,
                SkillLevel::INTERMEDIATE,
                SkillLevel::ADVANCED,
            ]),
            'skill_id' => Skill::factory(),
        ];
    }
}
