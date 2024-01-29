<?php

namespace Tests\Feature\Listeners;

use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Listeners\UnlockAchievement;
use App\Models\Achievement;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Tests\TestCase;

class UnlockAchievementTest extends TestCase
{
    public function testUnblocksCommentAchievement()
    {
        $user = User::factory()->create();

        Comment::factory()->count(5)->create(['user_id' => $user->id]);

        $fiveCommentsWrittenAchievement = Achievement::factory()->create([
            'points' => 5,
            'type' => Achievement::COMMENTS
        ]);

        //At this point we have only 5 comments created for this user
        $existingComment = Comment::first();

        $event = new CommentWritten($user, $existingComment);

        $listener = new UnlockAchievement();
        //should unlock the achievement of 5 written comments
        $listener->handle($event);

        $this->assertDatabaseHas('achievement_user', [
            'achievement_id' => $fiveCommentsWrittenAchievement->id,
            'user_id' => $user->id,
        ]);
    }

    public function testUnblocksLessonsWatchedAchievement()
    {
        $user = User::factory()->create();

        $lessons = Lesson::factory()->count(5)->create();

        $user->lessons()->attach($lessons->pluck('id'), ['watched' => true]);

        $fiveLessonWatchedAchievement = Achievement::factory()->create([
            'points' => 5,
            'type' => Achievement::LESSONS
        ]);

        //At this point we have only 5 lessons created for this user
        $existingLesson = Lesson::first();

        $event = new LessonWatched($user, $existingLesson);

        $listener = new UnlockAchievement();
        //should unlock the achievement of 5 written comments
        $listener->handle($event);

        $this->assertDatabaseHas('achievement_user', [
            'achievement_id' => $fiveLessonWatchedAchievement->id,
            'user_id' => $user->id,
        ]);
    }
}
