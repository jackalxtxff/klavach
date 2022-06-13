<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'about' => $this->faker->realText(100),
            'record_speed' => $this->faker->randomFloat(null, 0, 900),
            'avg_speed' => $this->faker->randomFloat(null, 0, 700),
            'avg_mistakes' => $this->faker->randomFloat(null, 0, 5),
            'count_games' => $this->faker->randomDigit(),
            'photo' => $this->faker->unique->imageUrl(400, 400),
            'user_id' => User::factory()->create()->id
        ];
    }
}
