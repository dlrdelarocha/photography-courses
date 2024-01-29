<?php

namespace Tests\Unit\Models;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BadgeTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */
    public function testGetNextBadge()
    {
        $currentBadge = Badge::factory()->addAchievementPoints(5)->create();

        $nextBadge = Badge::factory()->addAchievementPoints(9)->create();

        $result = Badge::getNextBadge($currentBadge);

        $this->assertEquals($nextBadge->id, $result->id);
    }

    public function testGetBadgesInfo()
    {
        $badge1 = Badge::factory()->create(['achievements_points' => 10]);
        $badge2 = Badge::factory()->create(['achievements_points' => 20]);

        $user = User::factory()->create();
        $user->badges()->attach($badge1);

        $badgesInfo = Badge::getBadgesInfo($user);

        $this->assertEquals([
            'currentBadge' => $badge1->name,
            'nextBadge' => $badge2->name,
            'pointsNeeded' =>  $badge2->achievements_points - $badge1->achievements_points
        ], $badgesInfo);
    }

    public function testScopeUnattainedByUser()
    {
        $existingBadge = Badge::factory()->create();

        $user = User::factory()->create();

        $user->badges()->attach($existingBadge);

        $unattainedBadges = Badge::unattainedByUser($user->id)->get();

        // Ensure that the assigned badge is not included in the unattained ones
        $this->assertFalse($unattainedBadges->contains($existingBadge));
    }
}
