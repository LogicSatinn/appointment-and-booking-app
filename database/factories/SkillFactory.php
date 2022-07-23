<?php

namespace Database\Factories;

use App\Enums\SkillLevel;
use App\Enums\SkillStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Skill;

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
    public function definition()
    {
        $sentence = $this->faker->sentence(4);
        return [
            'title' => $sentence,
            'slug' => $sentence,
            'description' => $this->faker->text,
            'mode_of_delivery' => $this->faker->text,
            'prerequisite' => $this->faker->text,
            'suitable_for' => $this->faker->text,
            'status' => $this->faker->randomElement([
                SkillStatus::DRAFT,
                SkillStatus::ARCHIVED,
                SkillStatus::PUBLISHED,
            ]),
            'category_id' => Category::factory(),
        ];
    }
}
