<?php

namespace App\Http\Controllers;

use App\Events\AchievementsUnlocked;
use App\Events\CommentWritten;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Illuminate\Events\queueable;

class CommentController extends Controller
{
    public function store(): void
    {
        //Simulating that a user is logged in and creating the comment.
        Auth::loginUsingId(User::first()->id);

        event(new AchievementsUnlocked(auth()->user(), "SDfsdfsdffds"));

//        $comment = Comment::first();
//
//        event(new CommentWritten(auth()->user(), $comment));
    }
}
