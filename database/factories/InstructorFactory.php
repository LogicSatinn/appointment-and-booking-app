<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstructorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instructor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'password' => $this->faker->password,
            'email_verified_at' => $this->faker->word,
            'banned_at' => $this->faker->dateTime(),
            'remember_token' => $this->faker->word,
        ];
    }
}
