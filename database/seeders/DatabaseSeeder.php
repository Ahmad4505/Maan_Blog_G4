<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Category table:
        // Category::factory(3)->create();
        // Tag::factory(10)->create();

        //Post Table:
        // $this->call([
        //     PostTableSeeder::class
        // ]);
        // abilities Table:
        $this->call([
            AbilitiesTableSeeder::class
        ]);

    }
}
