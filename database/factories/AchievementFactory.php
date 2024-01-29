<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    private static int $points = 1; // Ini
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'alias' => $this->faker->word,
            'type' =>  $this->faker->randomElement([
                Achievement::COMMENTS,
                Achievement::LESSONS
            ]),
            'points' => self::$points++,
        ];
    }

    public function addPoints($points): Factory
    {
        return $this->state([
            'points' => $points,
        ]);
    }
}
