<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $userRole = Role::create(['name' => 'user']);
        $writerRole = Role::create(['name' => 'writer']);

        // Create an admin user
        $admin = User::create([
            'name' => 'admin',
            'email' => 'solo@gmail.com',
            'password' => Hash::make('solosolo'), // Hash the password
        ]);

        // Assign the admin role to the user
        $admin->assignRole('admin');
    }
}
