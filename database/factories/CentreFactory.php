<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CentreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word(),
            'lieu' => $this->faker->word(),
        ];
    }
}
