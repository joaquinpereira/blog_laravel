<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6 , true),
            'excerpt' => $this->faker->paragraph(3 , true),
            'body' => $this->faker->paragraph(10 , true),
            'published_at' => Carbon::now()->subDays($this->faker->numberBetween($min = 1, $max = 10)),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
