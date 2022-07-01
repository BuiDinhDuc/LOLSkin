<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UniverseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'status' => 1

        ];
    }
}
