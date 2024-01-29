<?php

namespace App\Http\Controllers;

use App\Events\LessonWatched;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function watched()
    {
        //Simulating that a user is logged in and creating the comment.
        Auth::loginUsingId(User::first()->id);

        $lesson = Lesson::first();

        event(new LessonWatched(auth()->user(), $lesson));
    }
}
