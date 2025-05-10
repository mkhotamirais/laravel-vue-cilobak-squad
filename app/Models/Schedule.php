<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    protected $fillable = [
        'mata_pelajaran',
        'institusi',
        'tanggal',
        'materi_diskusi',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'schedule_user', 'schedule_id', 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        // if ($filters['search'] ?? false) {
        //     $query->where(function ($q) {
        //         $q->where('title', 'like', '%' . request('search') . '%')
        //             ->orWhere('description', 'like', '%' . request('search') . '%');
        //     });
        // }

        if ($filters['search'] ?? false) {
            $query->where('mata_pelajaran', 'like', '%' . request('search') . '%');
        }

        if ($filters['institusi'] ?? false) {
            $query->where('institusi', request('institusi'));
        }

        if ($filters['userid'] ?? false) {
            $query->whereHas('users', function ($q) use ($filters) {
                $q->where('users.id', $filters['userid']);
            });
        }
    }

    // public function updateAndShiftSchedules($fields)
    // {
    //     // Menghitung selisih hari antara tanggal lama dan tanggal baru
    //     $oldDate = Carbon::parse($this->tanggal);
    //     $newDate = Carbon::parse($fields['tanggal']);
    //     $dateDiff = $oldDate->diffInDays($newDate);

    //     // Update data schedule
    //     $this->update($fields);

    //     // Dapatkan semua jadwal yang terkait dengan mata pelajaran ini
    //     $schedules = Schedule::where('mata_pelajaran', $this->mata_pelajaran)
    //         ->where('id', '!=', $this->id) // Menghindari jadwal yang sedang diperbarui
    //         ->orderBy('tanggal')
    //         ->get();

    //     // Geser jadwal berikutnya
    //     foreach ($schedules as $nextSchedule) {
    //         // Geser tanggal berdasarkan perbedaan tanggal
    //         $nextSchedule->tanggal = Carbon::parse($nextSchedule->tanggal)->addDays($dateDiff);
    //         $nextSchedule->save();
    //     }

    //     // Mengupdate relasi user
    //     $this->users()->sync($fields['users']); // sync untuk memperbarui user yang terkait
    // }

    // // Fungsi untuk menghapus jadwal dan menggeser jadwal setelahnya
    // public function destroyAndShiftSchedules()
    // {
    //     // Menghitung selisih hari antara tanggal yang dihapus dan jadwal yang ada
    //     $dateDiff = Carbon::parse($this->tanggal)->diffInDays(now());

    //     // Menghapus relasi users terlebih dahulu, jika ada
    //     $this->users()->detach(); // detach untuk menghapus relasi tanpa menghapus data user

    //     // Hapus jadwal
    //     $this->delete();

    //     // Mengupdate jadwal berikutnya dengan menggeser tanggal
    //     $nextSchedules = Schedule::where('mata_pelajaran', $this->mata_pelajaran)
    //         ->where('tanggal', '>', $this->tanggal) // Jadwal setelah tanggal yang dihapus
    //         ->orderBy('tanggal')
    //         ->get();

    //     foreach ($nextSchedules as $nextSchedule) {
    //         // Geser tanggal berdasarkan selisih hari
    //         $nextSchedule->tanggal = Carbon::parse($nextSchedule->tanggal)->subDays($dateDiff);
    //         $nextSchedule->save();
    //     }
    // }
}
