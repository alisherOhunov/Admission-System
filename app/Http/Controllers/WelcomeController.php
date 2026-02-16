<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class WelcomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->isApplicant()) {
                return redirect()->route('applicant.dashboard');
            } else {
                return redirect()->route('admin.dashboard');
            }
        }
        $settings = SiteSetting::getOrCreate();

        return view('welcome', compact('settings'));
    }
}
