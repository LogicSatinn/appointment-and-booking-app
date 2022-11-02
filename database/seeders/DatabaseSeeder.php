<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        Resource::factory()->create([
            'name' => 'Lab 1',
            'slug' => Str::slug(title: 'Lab 1'),
            'created_by' => $user->id,
        ]);

        $categoryData = [
            [
                'name' => 'Programming',
                'slug' => Str::slug(title: 'Programming'),
                'note' => null,
                'created_by' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Soft Skills',
                'slug' => Str::slug(title: 'Soft Skills'),
                'note' => null,
                'created_by' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Digital Workshops',
                'slug' => Str::slug(title: 'Digital Workshops'),
                'note' => null,
                'created_by' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Life Hacks',
                'slug' => Str::slug(title: 'Life Hacks'),
                'note' => null,
                'created_by' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Category::insert($categoryData);
    }
}
