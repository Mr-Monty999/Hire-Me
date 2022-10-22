<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "content" => $this->faker->realText(),
            "photo" => $this->faker->imageUrl,
            "user_id" => $this->faker->randomElement(User::pluck("id")->toArray())
        ];
    }
}
