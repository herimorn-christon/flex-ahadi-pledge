<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class dependantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id'=>rand(20),
            'fullName'=>fake()->name(),
            'birth_date'=>fake()->date(),
            'relationship'=>'father',

        ];
    }
}
