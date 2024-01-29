<?php

namespace Tests\Unit\Models;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */

    public function testCurrentBadgeReturnsHighestAchievementsPointsBadge()
    {
        $badge1 = Badge::factory()->create(['achievements_points' => 10]);
        $badge2 = Badge::factory()->create(['achievements_points' => 20]);

        //Adds the badges to the user.
        $userWithBadges = User::factory()->create();
        $userWithBadges->badges()->attach([$badge1->id, $badge2->id]);

        $currentBadge = $userWithBadges->currentBadge();

        $this->assertInstanceOf(Badge::class, $currentBadge);
        $this->assertEquals($badge2->id, $currentBadge->id);
    }

}
