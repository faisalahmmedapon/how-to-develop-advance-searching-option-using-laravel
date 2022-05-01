<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numerify('1'),
            'title' => Str::random(100),
            'post_slug' => Str::random(100),
            'description' => Str::random(500),
            'post_image' => $this->faker->image('public/uploads/post',640,480, null, false),
            'status' => $this->faker->numerify('1'),
        ];
    }
}
