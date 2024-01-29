<?php

namespace Database\Seeders;

use App\Models\Badge;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        DB::table('badges')->insert([
            [
                'name' => 'Beginner',
                'alias' => 'beginner',
                'achievements_points' => 0,
                'description' => 'No achievements yet',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'name' => 'Intermediate',
                'alias' => 'intermediate',
                'achievements_points' => 4,
                'description' => 'Unlocked after 4 achievements',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'name' => 'Advanced',
                'alias' => 'advanced',
                'achievements_points' => 8,
                'description' => 'Unlocked after 8 achievements',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'name' => 'Master',
                'alias' => 'master',
                'achievements_points' => 10,
                'description' => 'Unlocked after 10 achievements',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ]);
    }
}
