<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            ['website_id' => 1, 'title' => 'New Tech Trends', 'description' => 'Discover the latest in tech trends.', 'created_at' => now(), 'updated_at' => now()],
            ['website_id' => 1, 'title' => 'AI Innovations', 'description' => 'How AI is shaping the future.', 'created_at' => now(), 'updated_at' => now()],
            ['website_id' => 2, 'title' => 'Best Pasta Recipes', 'description' => 'Delicious pasta recipes you can try.', 'created_at' => now(), 'updated_at' => now()],
            ['website_id' => 3, 'title' => 'Top Destinations 2024', 'description' => 'Must-visit places in 2024.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
