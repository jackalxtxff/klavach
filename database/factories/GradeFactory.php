<?php

namespace Database\Factories;

use App\Models\Dictionary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        $dictionaries = Dictionary::all();
        return [
            'user_id' => $this->faker->numberBetween(1, $users->count()),
            'dictionary_id' => $this->faker->numberBetween(1, $dictionaries->count()),
            'grade' => $this->faker->numberBetween(1, 5)
        ];
    }
}
