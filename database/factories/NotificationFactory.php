<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "type" => $this->faker->numberBetween(1, 5),
            "data" => $this->faker->text(30),
            "profile_id" => $this->faker->randomElement(Profile::pluck("id")->toArray()),

        ];
    }
}