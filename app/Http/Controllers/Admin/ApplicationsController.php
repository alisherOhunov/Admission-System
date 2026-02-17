<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ApplicationsExport;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationPeriod;
use App\Models\Document;
use App\Models\Program;
use App\Models\StaffNote;
use App\Notifications\ApplicationStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

        if ($request->filled('period')) {
            $query->where('application_period_id', $request->period);
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
        $periods = ApplicationPeriod::orderBy('start_date', 'desc')->get();

        if ($request->header('HX-Request')) {
            return view('admin.applications.partials.table', compact('applications', 'programs'));
        }

        return view('admin.applications.index', compact('applications', 'programs', 'periods'));
    }

    public function export(Request $request)
    {
        $filename = 'applications_'.now()->format('Y-m-d_H-i-s').'.xlsx';

        try {
            return Excel::download(new ApplicationsExport($request), $filename);
        } catch (\Exception $e) {
            \Log::error('Applications export failed: '.$e->getMessage());

            if ($request->header('HX-Request')) {
                return response()->json(['error' => __('messages.operation_failed')], 500);
            }

            return redirect()->back()->with('error', __('messages.operation_failed'));
        }
    }

    public function show(int $application_id)
    {
        $application = Application::findOrFail($application_id);
        $application->load(['user', 'program', 'applicationPeriod']);
        $documents = $application->getImportantDocuments();

        return view('admin.applications.show', compact('application', 'documents'));
    }

    public function updateStatus(Request $request, int $application_id)
    {
        $application = Application::findOrFail($application_id);

        $request->validate([
            'status' => 'required|in:under_review,accepted,rejected,require_resubmit',
            'admin_resubmission_comment' => 'required_if:status,require_resubmit|max:500',
        ]);

        $oldStatus = $application->status;

        $application->update([
            'status' => $request->status,
            'admin_resubmission_comment' => $request->admin_resubmission_comment,
            'updated_at' => now(),
        ]);

        if ($oldStatus !== $request->status) {
            $applicationId = $application->id;

            dispatch(function () use ($applicationId) {
                $application = Application::with('user')->find($applicationId);
                $application->user->notify(new ApplicationStatusUpdated($application));
            })->afterResponse();
        }

        return response()->json([
            'success' => true,
            'status' => $application->status,
            'message' => 'Status updated successfully!',
        ]);
    }

    public function getApplicantDocument(int $application_id, int $file_id)
    {
        try {
            $document = Document::where('application_id', $application_id)
                ->where('id', $file_id)
                ->firstOrFail();

            $path = 'documents/'.$application_id.'/'.$document->filename;

            if (! Storage::disk('public')->exists($path)) {
                abort(404, 'File not found');
            }

            return Storage::disk('public')->download($path, $document->original_name);

        } catch (\Exception $e) {
            \Log::error('Failed to download document: '.$e->getMessage(), [
                'application_id' => $application_id,
                'file_id' => $file_id,
            ]);

            abort(404, 'Document not found');
        }
    }

    public function viewApplicantDocument(int $application_id, int $file_id)
    {
        try {
            $document = Document::where('application_id', $application_id)
                ->where('id', $file_id)
                ->firstOrFail();

            $path = 'documents/'.$application_id.'/'.$document->filename;

            if (! Storage::disk('public')->exists($path)) {
                abort(404, 'File not found');
            }

            $fileContents = Storage::disk('public')->get($path);

            return response($fileContents)
                ->header('Content-Type', $document->mime_type)
                ->header('Content-Disposition', 'inline; filename="'.$document->original_name.'"')
                ->header('X-Frame-Options', 'SAMEORIGIN');

        } catch (\Exception $e) {
            \Log::error('Failed to view document: '.$e->getMessage(), [
                'application_id' => $application_id,
                'file_id' => $file_id,
            ]);

            abort(404, 'Document not found');
        }
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
}
