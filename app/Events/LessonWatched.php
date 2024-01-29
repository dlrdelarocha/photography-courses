<?php

namespace App\Events;

use App\Models\Achievement;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class LessonWatched
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public Authenticatable | User $user,
        public Lesson $lesson,
        public $type = Achievement::LESSONS,
    )
    {}
}
