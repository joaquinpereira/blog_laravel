<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6 , true);
        return [
            'title' => $title,
            'url' => Str::slug($title),
            'excerpt' => $this->faker->sentence(20 , true),
            'body' => $this->faker->paragraph(30 , true),
            'published_at' => Carbon::now()->subDays($this->faker->numberBetween($min = 1, $max = 200)),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 2),
        ];
    }
}
