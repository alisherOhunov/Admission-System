<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsSettingsController extends Controller
{
    public function index()
    {
        $programs = Program::all();

        return view('admin.applications.program-settings', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'degree_level' => 'required|in:bachelors,masters',
            'code' => 'required|string|max:255',
        ]);

        Program::create($validated);

        return redirect()->route('admin.applications.settings.programs')
            ->with('success', __('messages.program_created'));
    }

    public function activate(Program $program)
    {
        $program->update(['is_active' => true]);

        return back()->with('success', __('messages.program_activated'));
    }

    public function deActivate(Program $program)
    {
        $program->update(['is_active' => false]);

        return back()->with('success', __('messages.program_deactivated'));
    }

    public function edit(Program $program)
    {
        return view('admin.applications.edit-program', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'degree_level' => 'required|in:bachelors,masters',
            'code' => 'required|string|max:255',
        ]);

        $program->update($validated);

        return redirect()
            ->route('admin.applications.settings.programs')
            ->with('success', __('messages.program_updated'));
    }

    public function destroy(Program $program)
    {
        if ($program->applications()->exists()) {
            return redirect()
                ->route('admin.applications.settings.programs')
                ->with('error', __('messages.cannot_delete_program_in_use'));
        }

        if ($program->is_active) {
            return redirect()
                ->route('admin.applications.settings.programs')
                ->with('error', __('messages.cannot_delete_active_program'));
        }

        $program->delete();

        return redirect()
            ->route('admin.applications.settings.programs')
            ->with('success', __('messages.program_deleted'));
    }
}
