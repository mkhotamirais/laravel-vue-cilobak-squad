<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'mata_pelajaran',
        'institusi',
        'tanggal',
        'peserta',
        'materi_diskusi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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

        if ($filters['peserta'] ?? false) {
            $query->where('peserta', 'like', '%' . request('peserta') . '%');
        }
    }
}
