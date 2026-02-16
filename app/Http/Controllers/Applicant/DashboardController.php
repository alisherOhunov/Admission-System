<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\ApplicationPeriod;
use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $application = $user->getCurrentApplication();
        $settings = SiteSetting::getOrCreate();
        $activePeriod = ApplicationPeriod::where('is_active', true)->first();
        $selectedProgram = null;

        if ($application && $application->program_id) {
            $selectedProgram = Program::find($application->program_id);
        }

        // Calculate progress for draft applications
        $progress = 0;
        if ($application && $application->isDraft()) {
            $progress = $application->getProgressPercentage();
        }

        return view('applicant.dashboard', compact(
            'user',
            'application',
            'activePeriod',
            'selectedProgram',
            'progress',
            'settings'
        ));
}
}
