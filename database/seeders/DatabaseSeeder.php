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
        // User
        User::create([
            'id' => 1,
            'name' => 'ahmad',
            'email' => 'ahmad@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
        ]);
        User::create([
            'id' => 2,
            'name' => 'abdul',
            'email' => 'abdul@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
        ]);

        // Schedule
        Schedule::create([
            'user_id' => 1,
            'mata_pelajaran' => 'Matematika',
            'institusi' => 'ptiq_h',
            'tanggal' => '2025-05-08',
            'peserta' => 'ahmad,abdul,siti',
            'materi_diskusi' => 'Pembahasan Soal Ujian panjang',
        ]);
        Schedule::create([
            'user_id' => 1,
            'mata_pelajaran' => 'Bahasa Indonesia',
            'institusi' => 'pku_b',
            'tanggal' => '2025-05-09',
            'peserta' => 'ahmad,abdul,siti,ayu',
            'materi_diskusi' => 'Pembahasan Soal Ujian dua',
        ]);
        Schedule::create([
            'user_id' => 2,
            'mata_pelajaran' => 'Bahasa Inggris',
            'institusi' => 'pku_p',
            'tanggal' => '2025-05-10',
            'peserta' => 'abdul,siti,ayu,intan',
            'materi_diskusi' => 'Pembahasan Soal Ujian tiga',
        ]);
        Schedule::create([
            'user_id' => 2,
            'mata_pelajaran' => 'Bahasa Inggris',
            'institusi' => 'ptiq_h',
            'tanggal' => '2025-05-11',
            'peserta' => 'siti,ayu,intan',
            'materi_diskusi' => 'Pembahasan Soal Ujian empat',
        ]);
    }
}
