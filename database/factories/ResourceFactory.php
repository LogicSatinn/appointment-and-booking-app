<?php

namespace Database\Factories;

use App\States\Resource\Available;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Resource;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'name' => $name,
            'slug' => $name,
            'note' => $this->faker->paragraph,
            'capacity' => $this->faker->numberBetween(100, 900),
            'state' => Available::class,
        ];
    }
}
