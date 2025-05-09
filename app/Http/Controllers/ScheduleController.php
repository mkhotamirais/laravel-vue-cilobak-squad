<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::filter(request(['search', 'institusi', 'peserta']))
            ->orderBy('tanggal', 'asc')
            ->paginate(4)
            ->withQueryString();
        $msg = session('msg');
        $searchTerm = $request->search;
        $institusiTerm = $request->institusi;
        $pesertaTerm = $request->peserta;

        return inertia('Home', compact('schedules', 'msg', 'searchTerm', 'institusiTerm', 'pesertaTerm'));
    }

    public function create()
    {
        return inertia('Create');
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'mata_pelajaran' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'peserta' => 'required|string|max:255',
            'materi_diskusi' => 'required|string|max:255',
        ]);

        $fields['peserta'] = implode(',', array_unique(array_filter(array_map('trim', explode(',', $request->peserta)))));

        $request->user()->schedules()->create($fields);

        return redirect()->route('home')->with('msg', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        return inertia('Edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $fields = $request->validate([
            'mata_pelajaran' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'peserta' => 'required|string|max:255',
            'materi_diskusi' => 'required|string|max:255',
        ]);

        $fields['peserta'] = implode(',', array_unique(array_filter(array_map('trim', explode(',', $request->peserta)))));

        $schedule->update($fields);

        return redirect()->route('home')->with('msg', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('home')->with('msg', 'Jadwal berhasil dihapus.');
    }
}
