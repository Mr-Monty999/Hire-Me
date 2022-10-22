<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->jobTitle,
            "description" => $this->faker->realText,
            "location" => $this->faker->country . "," . $this->faker->city,
            "user_id" => $this->faker->randomElement(User::pluck("id")->toArray())
        ];
    }
}
