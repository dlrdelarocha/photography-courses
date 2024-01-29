<?php

namespace App\Providers;

use App\Events\AchievementsUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Listeners\CommentAchievement;
use App\Listeners\UnlockAchievement;
use App\Listeners\CheckAndUnlockAchievement;
use App\Listeners\UnlockBadge;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CommentWritten::class => [
            UnlockAchievement::class,
        ],
        LessonWatched::class => [
            UnlockAchievement::class,
        ],
        AchievementsUnlocked::class => [
            UnlockBadge::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
