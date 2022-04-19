<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DictionaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        return [
            'user_id' => $this->faker->numberBetween(1, $users->count()),
            'is_publish' => $this->faker->numberBetween(0, 1),
            'is_moderation' => $this->faker->numberBetween(0, 1),
            'title' => $this->faker->company(),
            'description' => $this->faker->realText(100),
            'information' => $this->faker->realText(300),
            'type_id' => $this->faker->numberBetween(1, 4),
            'Language_id' => $this->faker->numberBetween(1, 4)
        ];
    }
}
