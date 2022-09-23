<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "start" => $this->faker->date,
            "end" => $this->faker->date,
            "position" => $this->faker->jobTitle,
            "company_name" => $this->faker->company,
            "profile_id" => $this->faker->randomElement(Profile::pluck("id")),

        ];
    }
}
