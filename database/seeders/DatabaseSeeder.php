<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Skill;
use App\Models\Timetable;
use App\Models\User;
use App\States\Timetable\NotStarted;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Daniel Tairo',
            'email' => 'chaupele@hotmail.com',
        ]);

        $category = Category::factory()->create([
            'added_by' => $user->id
        ]);

        if (config('app.env') == 'local') {
            Skill::factory(4)
                 ->has(Timetable::factory()->count(3)->state([
                     'status' => NotStarted::class,
                 ]))
                ->for($category)
                 ->create();
        }
    }
}
