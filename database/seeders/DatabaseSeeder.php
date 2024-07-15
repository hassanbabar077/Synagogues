<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $administrator = \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'administrator@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $content_manager = \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('12345678'),
        ]);




    }
}
