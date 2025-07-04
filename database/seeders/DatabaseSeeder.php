<?php

namespace Database\Seeders;
use App\Models\Item;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'password' => '123123123',
        //     'email' => 'admin@email.com',
        // ]);

        \App\Models\Item::factory()->count(50)->create();

    }
}
