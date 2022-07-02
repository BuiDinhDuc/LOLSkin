<?php

namespace Database\Factories;

use App\Models\Skin;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Skin::class;
    public function definition()
    {
        return [
            'category_id'=> rand(1,48),
            'type_id' => rand(1,10),
            'champion_id' => rand(1,150),
            'name' => $this->faker->name(),
            'image' => '',
            'big_image' => '',
            'description' => $this->faker->text(),
            'price' => rand(0,799),
            'status' => 1
        ];
    }
}
