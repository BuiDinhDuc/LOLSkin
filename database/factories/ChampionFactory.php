<?php

namespace Database\Factories;

use App\Models\Champion;
use Illuminate\Database\Eloquent\Factories\Factory;
class ChampionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Champion::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'image' => '',
            'price' => $this->faker->randomElement([450,1350,3150,4800,6300,7800]),
            'status' => 1
        ];
    }
}
