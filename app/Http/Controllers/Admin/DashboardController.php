<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_applications' => Application::count(),
            'new_applications' => Application::where('created_at', '>=', now()->subDays(7))->count(),
            'under_review' => Application::byStatus('under_review')->count(),
            'accepted' => Application::byStatus('accepted')->count(),
            'rejected' => Application::byStatus('rejected')->count(),
            'submitted' => Application::byStatus('submitted')->count(),
        ];

        $recentApplications = Application::with(['user', 'program'])
            ->latest('submitted_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications'));
    }
}
