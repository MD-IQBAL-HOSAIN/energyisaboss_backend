<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole('admin');

        $agent = User::create([
            'name' => 'Agent',
            'email' => 'agent@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $agent->assignRole('agent');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('user');
    }
}
