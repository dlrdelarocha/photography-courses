<?php

namespace App\Listeners;

use App\Events\AchievementsUnlocked;
use App\Models\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockAchievement implements ShouldQueue
{

    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $unattainedAchievements = Achievement::whereType($event->type)
            ->unattainedByUser($event->user->id)
            ->get();

        //Check which achievements have already been reached.
        $newAchievements = $unattainedAchievements
            ->whereBetween('points', [0, $event->user->{$event->type}->count()]); //In case new achievements are added.

        if (!$newAchievements->isEmpty()) {
            $event->user->achievements()->syncWithoutDetaching($newAchievements->pluck('id')->toArray());

            //A good improvement would be to send an array of achievements.
            //This could help send better alerts to the user
            $newAchievements->map(function($newAchievement) use ($event) {
                /**
                 * This listener is called after the event is dispatched.
                 * @see UnlockBadge
                 */
                event(new AchievementsUnlocked($event->user, $newAchievement->name));
            });
        }
    }
}
