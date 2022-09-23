<?php

namespace Database\Factories;

use App\Models\Profile;
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
            "profile_id" => $this->faker->randomElement(Profile::pluck("id"))
        ];
    }
}
