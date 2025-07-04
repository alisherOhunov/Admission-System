<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Program;
use App\Models\StaffNote;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['user', 'program', 'applicationPeriod']);

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('level')) {
            $query->byLevel($request->level);
        }

        if ($request->filled('program')) {
            $query->where('program_id', $request->program);
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
                ->orWhereHas('program', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%");
                })
                ->orWhere('nationality', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        }

        $applications = $query->latest('submitted_at')->paginate(20);
        $programs = Program::active()->get();

        if ($request->header('HX-Request')) {
            return view('admin.applications.partials.table', compact('applications', 'programs'));
        }

        return view('admin.applications.index', compact('applications', 'programs'));
    }

    public function show(int $application_id)
    {
        $application = Application::findOrFail($application_id);
        $application->load(['user', 'program', 'applicationPeriod', 'documents']);

        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, int $application_id)
    {
        $application = Application::findOrFail($application_id);

        $request->validate([
            'status' => 'required|in:under_review,accepted,rejected,require_resubmit',
            'admin_resubmission_comment' => 'required_if:status,require_resubmit|max:500',
        ]);

        $application->update([
            'status' => $request->status,
            'admin_resubmission_comment' => $request->admin_resubmission_comment,
        ]);

        return response()->json([
            'success' => true,
            'status' => $application->status,
            'message' => 'Status updated successfully!',
        ]);
    }

    public function addNote(Request $request, int $application_id)
    {
        $request->validate([
            'note' => 'required|string|max:500',
        ]);

        StaffNote::create([
            'application_id' => $application_id,
            'staff_id' => $request->user()->id,
            'note' => $request->note,
        ]);

        return back();
    }

    public function export(Request $request)
    {
        // Export functionality would go here
        // This could generate CSV, Excel, or PDF exports
        return response()->json(['message' => 'Export functionality to be implemented']);
    }
}
