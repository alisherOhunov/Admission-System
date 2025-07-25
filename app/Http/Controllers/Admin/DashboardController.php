<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationPeriod;

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
            're_submitted' => Application::byStatus('re_submitted')->count(),
            'require_resubmit' => Application::byStatus('require_resubmit')->count(),
        ];

        $currentPeriod = ApplicationPeriod::where('is_active', true)->first();

        $recentApplications = Application::with(['user', 'program'])
            ->latest('submitted_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications', 'currentPeriod'));
    }
}
