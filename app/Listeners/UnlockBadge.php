<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use App\Models\Achievement;
use App\Models\Badge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockBadge
{
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
        $unattainedBadges = Badge::unattainedByUser($event->user->id)->get();

        //Check which badges have already been reached.
        $newBadges = $unattainedBadges
            ->whereBetween('achievements_points', [0, $event->user->achievements->count()]); //In case new achievements are added.

        if (!$newBadges->isEmpty()) {
            $event->user->badges()->syncWithoutDetaching($newBadges->pluck('id')->toArray());

            //A good improvement would be to send an array of achievements.
            //This could help send better alerts to the user
            $newBadges->map(function($newBadge) use ($event) {
                event(new BadgeUnlocked($event->user, $newBadge->name));
            });
        }



    }
}
