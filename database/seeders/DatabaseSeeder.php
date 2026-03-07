<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // user::factory(10)->create();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'adminn@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'admin2',
        ]);
    }
}
