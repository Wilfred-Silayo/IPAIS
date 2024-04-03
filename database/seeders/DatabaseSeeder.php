<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'username'=>Str::uuid(),
            'first_name' => 'Pascal',
            'last_name' => 'Charles',
            'email' => 'paschalcharlz@gmail.com',
        ]);
    }
}
