<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_name' => Str::random(10),
            'category_name_slug' => Str::random(10),
            'category_logo' => $this->faker->image('public/uploads/category',640,480, null, false),
            'status' => $this->faker->numberBetween(0,9),
        ];
    }
}
