<?php

namespace App\Events;

use App\Models\Achievement;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentWritten
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Authenticatable $user
     * It was added to identify the type of achievement
     * @param string $type
     */
    public function __construct(
        public Authenticatable | User $user,
        public Comment $comment,
        public string $type = Achievement::COMMENTS
    ) {}
}
