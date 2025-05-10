<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $user = $request->user();
        // $schedules = $request->user()->schedules()
        //     ->with('users:id,name')
        //     ->orderBy('tanggal', 'asc')
        //     ->paginate(4);

        // return inertia('Dashboard', compact('user', 'schedules'));
        return inertia('Dashboard');
    }

    public function userSchedule(Request $request)
    {
        $user = $request->user();
        $schedules = $request->user()->schedules()
            ->with('users:id,name')
            ->orderBy('tanggal', 'asc')
            ->paginate(4);

        return inertia('UserSchedule', compact('user', 'schedules'));
    }
}
