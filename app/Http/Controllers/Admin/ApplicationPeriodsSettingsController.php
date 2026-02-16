<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationPeriod;
use Illuminate\Http\Request;

class ApplicationPeriodsSettingsController extends Controller
{
    public function index(Request $request)
    {
        $periods = ApplicationPeriod::all();

        return view('admin.applications.period-settings', compact('periods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        ApplicationPeriod::create($validated);

        return redirect()->route('admin.applications.settings.periods')
            ->with('success', 'Application period added successfully.');
    }

    public function activate(ApplicationPeriod $period)
    {
        $period->update(['is_active' => true]);

        return back()->with('success', 'Application period activated successfully.');
    }

    public function deactivate(ApplicationPeriod $period)
    {
        // Count other active periods
        $activePeriodsCount = ApplicationPeriod::where('is_active', true)
            ->where('id', '!=', $period->id)
            ->count();

        // Prevent deactivation if this is the last active period
        if ($activePeriodsCount === 0) {
            return back()->with('error', 'Cannot deactivate the last active period. Please ensure at least one period remains active.');
        }

        $period->update(['is_active' => false]);

        return back()->with('success', 'Application period deactivated successfully.');
    }

    public function edit(ApplicationPeriod $period)
    {
        return view('admin.applications.edit-period', compact('period'));
    }

    public function update(Request $request, ApplicationPeriod $period)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $period->update($validated);

        return redirect()
            ->route('admin.applications.settings.periods')
            ->with('success', 'Application period updated successfully.');
    }

    public function destroy(ApplicationPeriod $period)
    {
        if ($period->applications()->exists()) {
            return redirect()
                ->route('admin.applications.settings.periods')
                ->with('error', 'Cannot delete this application period because it has associated applications.');
        }

        // Check if this is an active period
        if ($period->is_active) {
            // Count other active periods
            $activePeriodsCount = ApplicationPeriod::where('is_active', true)
                ->where('id', '!=', $period->id)
                ->count();

            // Prevent deletion if this is the last active period
            if ($activePeriodsCount === 0) {
                return redirect()
                    ->route('admin.applications.settings.periods')
                    ->with('error', 'Cannot delete the last active period. Please ensure at least one period remains active.');
            }
        }

        $period->delete();

        return redirect()
            ->route('admin.applications.settings.periods')
            ->with('success', 'Application period deleted successfully.');
    }
}
