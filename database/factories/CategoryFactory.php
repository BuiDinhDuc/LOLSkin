<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Category::class;
    public function definition()
    {
        return [
            'universe_id' => rand(1,50),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'status' => 1

        ];
    }
}
