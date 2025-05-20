<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::with('users:id,name')
            ->filter(request(['search', 'institusi', 'userid']))
            ->orderBy('tanggal', 'asc')
            ->paginate(8)
            ->withQueryString();
        $msg = session('msg');
        $searchTerm = $request->search;
        $institusiTerm = $request->institusi;
        $userTerm = User::find($request->userid)->name ?? null;
        $userid = $request->userid;

        return inertia('Home', compact('schedules', 'msg', 'searchTerm', 'institusiTerm', 'userTerm', 'userid'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get(['id', 'name'])
            ->map(function ($user) {
                return ['label' => $user->name, 'value' => $user->id];
            });

        return inertia('Create', compact('users'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'mata_pelajaran' => 'required|string|max:255',
            'institusi' => 'required',
            'users' => 'required|array', // users tidak wajib
            // 'tanggal' => 'required|date|after:now',
            'tanggal' => 'required|date|unique:schedules,tanggal',
            'materi_diskusi' => 'required|string|max:255',
        ]);

        $schedule = $request->user()->schedulescreator()->create($fields);

        $schedule->users()->sync($fields['users'] ?? []);

        return redirect()->route('home')->with('msg', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        $schedule->load('users:id,name');
        $schedule->tanggal = Carbon::parse($schedule->tanggal)->format('Y-m-d\TH:i');
        $users = User::orderBy('name')->get(['id', 'name'])
            ->map(function ($user) {
                return ['label' => $user->name, 'value' => $user->id];
            });

        return inertia('Edit', compact('schedule', 'users'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $fields = $request->validate([
            'mata_pelajaran' => 'required|string|max:255',
            'institusi' => 'required',
            'users' => 'required|array', // users tidak wajib
            'tanggal' => 'required|date|unique:schedules,tanggal,' . $schedule->id,
            'materi_diskusi' => 'required|string|max:255',
        ]);

        $oldDate = Carbon::parse($schedule->tanggal);
        $newDate = Carbon::parse($fields['tanggal']);

        $schedule->update($fields);
        $schedule->users()->sync($fields['users'] ?? []);

        if (!$oldDate->equalTo($newDate)) {
            // Ambil semua jadwal yang ID-nya lebih besar dari jadwal yang baru diubah
            $nextSchedules = Schedule::where('id', '>', $schedule->id)
                ->orderBy('id')
                ->get();

            $nextDate = $newDate->copy()->addDays(7); // Jadwal berikutnya dimulai 7 hari dari tanggal baru

            foreach ($nextSchedules as $nextSchedule) {
                $nextSchedule->update([
                    'tanggal' => $nextDate->format('Y-m-d'),
                ]);

                $nextDate->addDays(7); // setiap jadwal +7 hari
            }
        }

        return redirect()->route('home')->with('msg', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        // $schedule->destroyAndShiftSchedules();
        $schedule->users()->detach();
        $schedule->delete();
        return redirect()->route('home')->with('msg', 'Jadwal berhasil dihapus.');
    }
}
