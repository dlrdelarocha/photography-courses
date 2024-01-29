<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

class BadgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Badge::class;

    private static int $points = 5;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'alias' => $this->faker->word(),
            'achievements_points' => self::$points++,
            'description' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function addAchievementPoints($achievementsPoints): Factory
    {
        return $this->state([
            'achievements_points' => $achievementsPoints,
        ]);
    }
}
