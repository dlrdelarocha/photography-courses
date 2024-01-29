<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user)  {
            $user->comments()->saveMany(Comment::factory(rand(0,30))->make());
            $user->lessons()->attach(Lesson::factory(rand(0,30))->create(), ['watched' => true]);
        });
    }
}
