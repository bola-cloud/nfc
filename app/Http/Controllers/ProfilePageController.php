<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfilePageController extends Controller
{
    public function show($slug)
    {
        // Find the profile by slug
        $profile = Profile::where('slug', $slug)->first();

        if (!$profile) {
            abort(404, 'Profile not found');
        }

        // Return a web view for the profile
        return view('scanned-profile.show', compact('profile'));
    }

    // Helper to detect mobile app request
    private function isMobileApp()
    {
        // Add logic to detect app-specific headers
        return str_contains(request()->header('User-Agent'), 'MyApp');
    }
}
