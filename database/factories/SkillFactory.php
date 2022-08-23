<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Skill;
use App\States\Skill\Draft;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $sentence = $this->faker->sentence(4);

        return [
            'title' => $sentence,
            'slug' => $sentence,
            'description' => $this->faker->text,
            'mode_of_delivery' => $this->faker->text,
            'prerequisite' => $this->faker->text,
            'suitable_for' => $this->faker->text,
            'status' => Draft::class,
            'category_id' => Category::factory(),
        ];
    }
}
