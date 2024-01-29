<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Database\Factories\AchievementFactory;
use Database\Factories\BadgeFactory;
use Tests\TestCase;

class AchievementControllerTest extends TestCase
{
    /**
     * Note: Point to Badges and Achievement are auto-incremental.
     * @see AchievementFactory
     * @see BadgeFactory
     */
    public function getsAchievementsByUser(): void
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);

        //In this case, only the correctness of the structure was verified,
        //as the methods that retrieve the values
        //have already been reviewed in the unit tests.
        $response->assertJsonStructure([
            'unlocked_achievements',
            'next_available_achievements',
            'current_badge',
            'next_badge',
            'remaining_to_unlock_next_badge',
        ]);
    }
}
