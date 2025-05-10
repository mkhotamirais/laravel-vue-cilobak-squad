<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan UserSeeder
        $this->call(UserSeeder::class);

        // Menjalankan ScheduleSeeder
        $this->call(ScheduleSeeder::class);
    }
}
