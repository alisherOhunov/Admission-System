<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Get the collection of applications based on filters
     */
    public function collection()
    {
        $query = Application::with(['user', 'program', 'applicationPeriod']);

        if ($this->request->filled('status')) {
            $query->byStatus($this->request->status);
        }

        if ($this->request->filled('level')) {
            $query->byLevel($this->request->level);
        }

        if ($this->request->filled('search')) {
            $search = $this->request->get('search');
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

        return $query->latest('submitted_at')->get();
    }

    /**
     * Define the headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'ID',
            'First name',
            'Last name',
            'Gender',
            'Family Status',
            'Date of Birth',
            'Country of Birth',
            'Passport Number',
            'Email',
            'Phone',
            'Level ',
            'Program',
            'Submitted',
            'Status',
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($application): array
    {
        $countries = config('countries');

        return [
            $application->id,
            $application->user->first_name ?? 'N/A',
            $application->user->last_name ?? 'N/A',
            $application->gender == 1 ? 'Male' : ($application->gender == 2 ? 'Female' : 'N/A'),
            $application->family_status == 1 ? 'Single' : ($application->family_status == 2 ? 'Married' : 'N/A'),
            $application->date_of_birth ? $application->date_of_birth->format('Y-m-d') : 'N/A',
            $countries[$application->country_of_birth] ?? 'N/A',
            $application->passport_number ?? 'N/A',
            $application->email ?? 'N/A',
            $application->phone ?? 'N/A',
            $application->level ?? 'N/A',
            $application->program->name ?? 'N/A',
            $application->submitted_at ? $application->submitted_at->format('Y-m-d H:i:s') : 'N/A',
            $application->status ?? 'N/A',
        ];
    }
}
