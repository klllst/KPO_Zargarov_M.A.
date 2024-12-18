<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Группа' . fake()->unique()->numberBetween(1, 100),
            'course' => fake()->numberBetween(1,4),
            'number' => fake()->numberBetween(1,3),
            'faculty_id' => Faculty::first()->id,
        ];
    }
}
