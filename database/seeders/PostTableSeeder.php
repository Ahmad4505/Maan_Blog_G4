<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title'=> 'Sample Post Title',
            'slug'=> 'Sample-Post-Title',
            'content'=> 'Sample Post Content. Sample Post Content.',
            'category_id'=> 1,
        ]);
    }
}
