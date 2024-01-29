<?php

namespace Tests\Unit\Models;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AchievementTest extends TestCase
{
    use DatabaseTransactions;

    public function testScopeUnattainedByUser()
    {
        $user = User::factory()->create();

        $achievement = Achievement::factory()->create();

        $user->achievements()->attach($achievement);

        // Apply the scope to retrieve achievements not attained by the user
        $unattainedAchievements = Achievement::unattainedByUser($achievement->id)->get();

        // Ensure that the assigned achievement is not included in the unattained ones
        $this->assertFalse($unattainedAchievements->contains($achievement));
    }
}
