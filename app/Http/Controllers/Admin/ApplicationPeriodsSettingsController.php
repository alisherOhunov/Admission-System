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
        ApplicationPeriod::where('is_active', true)->update(['is_active' => false]);

        $period->update(['is_active' => true]);

        return back()->with('success', 'Application period activated successfully.');
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
        if ($period->is_active) {
            return redirect()
                ->route('admin.applications.settings.periods')
                ->with('error', 'You cannot delete the active period. Please activate another period before deleting this one.');
        }

        $period->delete();

        return redirect()
            ->route('admin.applications.settings.periods')
            ->with('success', 'Application period deleted successfully.');
    }
}
