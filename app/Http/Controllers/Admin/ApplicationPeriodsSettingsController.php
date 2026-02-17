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
            ->with('success', __('messages.period_created'));
    }

    public function activate(ApplicationPeriod $period)
    {
        // Deactivate all other active periods
        ApplicationPeriod::where('is_active', true)
            ->where('id', '!=', $period->id)
            ->update(['is_active' => false]);

        // Activate the selected period
        $period->update(['is_active' => true]);

        return back()->with('success', __('messages.period_activated'));
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
            ->with('success', __('messages.period_updated'));
    }

    public function destroy(ApplicationPeriod $period)
    {
        if ($period->applications()->exists()) {
            return redirect()
                ->route('admin.applications.settings.periods')
                ->with('error', __('messages.cannot_delete_period_in_use'));
        }

        $period->delete();

        return redirect()
            ->route('admin.applications.settings.periods')
            ->with('success', __('messages.period_deleted'));
    }
}
