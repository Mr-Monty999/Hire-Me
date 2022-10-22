<?php

namespace Database\Factories;

use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPhoneFactory extends Factory
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
            "user_id" => $this->faker->randomElement(User::pluck("id"))
        ];
    }
}
