<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;

class AchievementController extends Controller
{
    public function index(User $user): array
    {
        $badgesInfo = Badge::getBadgesInfo($user);

        $unattainedAchievements = Achievement::unattainedByUser($user->id)
            ->get();

        return [
            'unlocked_achievements' => $user->achievements()->get(),
            'next_available_achievements' => $unattainedAchievements,
            'current_badge' => $badgesInfo['currentBadge'],
            'next_badge' => $badgesInfo['nextBadge'],
            'remaing_to_unlock_next_badge' => $badgesInfo['pointsNeeded']
        ];
    }
}
