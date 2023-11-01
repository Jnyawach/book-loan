<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'customer_id'=>fake()->numberBetween(1,100),
            'question_id'=>fake()->numberBetween(1,3),
            'value'=>fake()->numberBetween(1,5)
        ];
    }
}
