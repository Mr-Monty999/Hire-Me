<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "firstname" => $this->faker->firstName,
            "lastname" => $this->faker->lastName,
            "nickname" => $this->faker->name,
            "gender" => $this->faker->randomElement(["ذكر", "أنثى"]),
            "about" => $this->faker->text(),
            "birthdate" => $this->faker->date,
            "background_photo" => $this->faker->imageUrl,
            "website" => $this->faker->domainName,
            "country" => $this->faker->country,
            "city" => $this->faker->city,
            "state" => $this->faker->city,
            "street" => $this->faker->streetAddress,
            "university" => $this->faker->word,
            "degree" => $this->faker->word,
            "study_type" => $this->faker->bloodType,
            "user_id" => $this->faker->unique()->randomElement(User::pluck("id")),

        ];
    }
}
