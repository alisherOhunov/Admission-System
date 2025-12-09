<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function index()
    {
        $universityFile = storage_path('app/university_name.txt');
        $universityName = 'State Academy of Sports of Uzbekistan!';

        if (File::exists($universityFile)) {
            $universityName = trim(File::get($universityFile));
        }

        return view('admin.applications.site-setting', compact('universityName'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'university_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png|max:5120',
            'favicon' => 'nullable|image|mimes:png|max:5120',
        ]);

        // Update university name in text file
        $universityFile = storage_path('app/university_name.txt');
        File::put($universityFile, $request->university_name);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = public_path('images');

            // Create directory if it doesn't exist
            if (! File::exists($logoPath)) {
                File::makeDirectory($logoPath, 0755, true);
            }

            $request->file('logo')->move($logoPath, 'logo.png');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $request->file('favicon')->move(public_path(), 'favicon.ico');
        }

        // Return 200 status - frontend will handle the alert
        return response()->json(['success' => true], 200);
    }
}
