<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dd = $this->faker->date('Y-m-d');
        $ds = new \DateTime($dd);
        do {
            $df = $this->faker->date('Y-m-d');
        } while (($ds->diff(new \DateTime($df)))->format("%r%a") <= 0);
        return [
            'nom' => $this->faker->word(),
            'dd' => $dd,
            'df' => $df,
            'numMarche' => $this->faker->randomNumber(5, true),
            'numConvention' => $this->faker->regexify('[A-Z0-9]{12}'),
            'centre_id' => $this->faker->randomDigitNotNull(),
        ];
    }
}
