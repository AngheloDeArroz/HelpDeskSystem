<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $supportRole = Role::where('name', 'Support')->first();
        $userRole = Role::where('name', 'User')->first();

        User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id
        ]);

        User::firstOrCreate([
            'email' => 'support@example.com'
        ], [
            'name' => 'Support User',
            'password' => Hash::make('password'),
            'role_id' => $supportRole->id
        ]);

        // Create 5 normal users
        for ($i = 1; $i <= 2; $i++) {
            User::firstOrCreate([
                'email' => "user{$i}@example.com"
            ], [
                'name' => "User {$i}",
                'password' => Hash::make('password'),
                'role_id' => $userRole->id
            ]);
        }
    }
}
