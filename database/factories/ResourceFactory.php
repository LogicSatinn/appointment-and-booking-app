<?php

namespace Database\Factories;

use App\Models\Resource;
use App\States\Resource\Available;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        $name = $this->faker->name;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'note' => $this->faker->paragraph,
            'capacity' => $this->faker->numberBetween(100, 900),
            'state' => Available::class,
        ];
    }
}
