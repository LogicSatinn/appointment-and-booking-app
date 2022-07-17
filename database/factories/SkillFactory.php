<?php

namespace Database\Factories;

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
            'status' => $this->faker->randomElement([
                'Draft',
                'Published'
            ]),
            'category_id' => Category::factory(),
        ];
    }
}
