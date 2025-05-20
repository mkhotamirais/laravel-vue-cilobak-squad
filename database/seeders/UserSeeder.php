<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ahmad = User::create([
            'id' => 1,
            'name' => 'ahmad',
            'email' => 'ahmad@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'role' => 'admin'
        ]);

        $abdul = User::create([
            'id' => 2,
            'name' => 'abdul',
            'email' => 'abdul@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'role' => 'user'
        ]);

        $siti = User::create([
            'id' => 3,
            'name' => 'siti',
            'email' => 'siti@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'role' => 'user'
        ]);

        $ayu = User::create([
            'id' => 4,
            'name' => 'ayu',
            'email' => 'ayu@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'role' => 'user'
        ]);

        $intan = User::create([
            'id' => 5,
            'name' => 'intan',
            'email' => 'intan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'role' => 'user'
        ]);
    }
}
