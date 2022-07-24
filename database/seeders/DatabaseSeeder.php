<?php

namespace Database\Seeders;

use App\Models\Timetable;
use App\Models\Category;
use App\Models\Skill;
use App\Models\User;
use App\States\Timetable\NotStarted;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
             'name' => 'Daniel Tairo',
             'email' => 'chaupele@hotmail.com',
         ]);

         if (config('app.name') == 'local') {
             Skill::factory(4)
                 ->has(Timetable::factory()->count(3)->state([
                     'status' => NotStarted::class
                 ]))
                 ->for(Category::factory()->create())
                 ->create();
         }
    }
}
