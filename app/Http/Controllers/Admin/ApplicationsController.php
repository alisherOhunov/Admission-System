<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Program;
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

    public function show(Application $application)
    {
        $application->load(['user', 'program', 'applicationPeriod', 'documents']);

        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:submitted,review,accepted,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function addNote(Request $request, Application $application)
    {
        $request->validate([
            'note' => 'required|string',
        ]);

        $application->staffNotes()->create([
            'staff_id' => auth()->id(),
            'note' => $request->note,
        ]);

        return response()->json(['message' => 'Note added successfully']);
    }

    public function export(Request $request)
    {
        // Export functionality would go here
        // This could generate CSV, Excel, or PDF exports
        return response()->json(['message' => 'Export functionality to be implemented']);
    }
}
