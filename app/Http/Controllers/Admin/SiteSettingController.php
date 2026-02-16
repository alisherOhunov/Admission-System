<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::getOrCreate();

        return view('admin.applications.site-setting', [
            'universityName' => $settings->university_name,
            'contactSupportLink' => $settings->contact_support_link,
            'studentAccommodationLink' => $settings->student_accommodation_link,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'university_name' => 'required|string|max:255',
            'contact_support_link' => 'nullable|url|max:500',
            'student_accommodation_link' => 'nullable|url|max:500',
            'logo' => 'nullable|image|mimes:png|max:5120',
            'favicon' => 'nullable|image|mimes:png|max:5120',
        ]);

        $settings = SiteSetting::getOrCreate();

        $settings->update([
            'university_name' => $request->university_name,
            'contact_support_link' => $request->contact_support_link ?? '',
            'student_accommodation_link' => $request->student_accommodation_link ?? '',
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = public_path('images');

            if (! File::exists($logoPath)) {
                File::makeDirectory($logoPath, 0755, true);
            }

            if (File::exists($logoPath.'/logo.png')) {
                File::delete($logoPath.'/logo.png');
            }

            $request->file('logo')->move($logoPath, 'logo.png');
        }

        if ($request->hasFile('favicon')) {
            $faviconPath = public_path('favicon.ico');

            if (File::exists($faviconPath)) {
                File::delete($faviconPath);
            }

            $request->file('favicon')->move(public_path(), 'favicon.ico');
        }

        return response()->json(['success' => true], 200);
    }
}
