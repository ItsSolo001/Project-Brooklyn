<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'solo@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('solosolo'), // Hash the password
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('admin');
    }
}
