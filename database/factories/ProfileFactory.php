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
            'nickname' => $this->faker->unique()->userName(),
            'about' => $this->faker->realText(100),
            'photo' => $this->faker->imageUrl(640, 480),
            'user_id' => User::factory()->create()->id
        ];
    }
}
