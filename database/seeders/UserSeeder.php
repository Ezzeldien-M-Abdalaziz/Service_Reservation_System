<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'user',
            'username' => 'Ezz',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        User::factory(50)->create();

    }
}
