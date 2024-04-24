<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bee;
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

        // Create a Queen Bee
        Bee::factory()->create([
            'type' => 'Queen',
            'health' => 100,
        ]);

        // Create 5 Worker Bees
        Bee::factory()->count(5)->create([
            'type' => 'Worker',
            'health' => 75,
        ]);

        // Create 8 Drone Bees
        Bee::factory()->count(8)->create([
            'type' => 'Drone',
            'health' => 50,
        ]);
    }
}
