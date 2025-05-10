<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedule1 = Schedule::create([
            'creator_id' => 1,
            'mata_pelajaran' => 'Matematika',
            'institusi' => 'ptiq_h',
            'tanggal' => '2025-05-08',
            'materi_diskusi' => 'Pembahasan Soal Ujian panjang',
        ]);
        $schedule1->users()->attach([1, 2, 3]);

        $schedule2 = Schedule::create([
            'creator_id' => 2,
            'mata_pelajaran' => 'Bahasa Indonesia',
            'institusi' => 'pku_b',
            'tanggal' => '2025-05-09',
            'materi_diskusi' => 'Pembahasan Soal Ujian dua',
        ]);
        $schedule2->users()->attach([1, 2, 3, 4]);

        $schedule3 = Schedule::create([
            'creator_id' => 1,
            'mata_pelajaran' => 'Bahasa Inggris',
            'institusi' => 'pku_p',
            'tanggal' => '2025-05-10',
            'materi_diskusi' => 'Pembahasan Soal Ujian tiga',
        ]);
        $schedule3->users()->attach([2, 3, 4, 5]);

        $schedule4 = Schedule::create([
            'creator_id' => 1,
            'mata_pelajaran' => 'Bahasa Inggris',
            'institusi' => 'ptiq_h',
            'tanggal' => '2025-05-11',
            'materi_diskusi' => 'Pembahasan Soal Ujian empat',
        ]);
        $schedule4->users()->attach([3, 4, 5]);
    }
}
