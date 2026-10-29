<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $counts = $request->user()->applications()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $total = $counts->sum();

        $upcomingInterviews = $request->user()->applications()
            ->where('interview_at', '>', now())
            ->oldest('interview_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact('counts', 'total', 'upcomingInterviews'));
    }
}
