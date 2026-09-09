<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $stats = [
            'projects'    => $user->projects()->count(),
            'tasks'       => $user->tasks()->count(),
            'done'        => $user->tasks()->where('status', 'done')->count(),
            'in_progress' => $user->tasks()->where('status', 'in_progress')->count(),
            'todo'        => $user->tasks()->where('status', 'todo')->count(),
            'overdue'     => $user->tasks()
                                ->whereDate('due_date', '<', today())
                                ->where('status', '!=', 'done')
                                ->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}