<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),        // e.g. "Car Wash"
            'description' => $this->faker->paragraph(),     // e.g. "We provide top-notch..."
            'price' => $this->faker->randomFloat(2, 10, 100), // e.g. 49.99
        ];
    }
}