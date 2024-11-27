<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscriptions')->insert([
            ['website_id' => 1, 'email' => 'techfan@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['website_id' => 2, 'email' => 'foodlover@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['website_id' => 3, 'email' => 'traveler@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['website_id' => 1, 'email' => 'developer@example.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
