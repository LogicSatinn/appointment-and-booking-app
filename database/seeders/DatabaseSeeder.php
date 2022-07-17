<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Skill;
use App\States\Appointment\Pending;
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
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@nia-lab.app',
         ]);

         Skill::factory(4)
             ->has(Appointment::factory()->count(3)->state([
                 'status' => Pending::class
             ]))
             ->for(Category::factory()->create())
             ->create();
    }
}
