<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('achievements')->insert([
            [
                'name' => 'First Lesson Watched',
                'alias' => 'first-lesson-watched',
                'type' => Achievement::LESSONS,
                'points' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '5 Lessons Watched',
                'alias' => '5-lessons-watched',
                'type' => Achievement::LESSONS,
                'points' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '10 Lessons Watched',
                'alias' => '10-lessons-watched',
                'type' => Achievement::LESSONS,
                'points' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '25 Lessons Watched',
                'alias' => '25-lessons-watched',
                'type' => Achievement::LESSONS,
                'points' => 25,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '50 Lessons Watched',
                'alias' => '50-lessons-watched',
                'type' => Achievement::LESSONS,
                'points' => 50,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'First Comment Written',
                'alias' => 'first-comment-written',
                'type' => Achievement::COMMENTS,
                'points' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '3 Comments Written',
                'alias' => '3-comments-written',
                'type' => Achievement::COMMENTS,
                'points' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '5 Comments Written',
                'alias' => '5-comments-written',
                'type' => Achievement::COMMENTS,
                'points' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '10 Comments Written',
                'alias' => '10-comments-written',
                'type' => Achievement::COMMENTS,
                'points' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '20 Comments Written',
                'alias' => '20-comments-written',
                'type' => Achievement::COMMENTS,
                'points' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

    }
}
