<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('websites')->insert([
            ['name' => 'Tech Blog', 'url' => 'https://techblog.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Food Blog', 'url' => 'https://foodblog.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Travel Blog', 'url' => 'https://travelblog.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
