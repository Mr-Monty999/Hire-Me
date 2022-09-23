<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilePhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "phone" => $this->faker->phoneNumber,
            "profile_id" => $this->faker->randomElement(Profile::pluck("id"))
        ];
    }
}
