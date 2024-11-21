<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class ProfileController extends Controller
{
    // GET Profile
    public function show()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the user's profile with related links
        $profile = $user->profile()->with('links')->first();

        if (!$profile) {
            return response()->json([
                'message' => 'Profile not found.',
                'status' => false,
                'data' => null,
            ], 404);
        }

        // Add profile_image_url to the response
        $profileData = $profile->toArray();
        $profileData['profile_image'] = $profile->profile_image_url;

        return response()->json([
            'message' => 'Profile retrieved successfully.',
            'status' => true,
            'data' => $profileData,
        ], 200);
    }

    // POST/UPDATE Profile
    public function update(Request $request)
    {
        $data = $request->validate([
            'bio' => 'nullable|string',
            'website' => 'nullable|url',
            'profile_image' => 'nullable|image|max:2048', // Image validation with max size 2MB
            'company' => 'nullable|string',
            'job_title' => 'nullable|string',
        ]);
    
        $user = Auth::user();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $uploadedFile = $request->file('profile_image');
    
            // Store the file and get the path
            $path = $uploadedFile->store('profile_images', 'public');
    
            // Update the `profile_image` field with the stored path
            $data['profile_image'] = $path;
    
            // Optionally delete the old image if it exists
            if ($profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }
        }
    
        $profile->fill($data);
        $profile->save();
    
        return response()->json([
            'message' => 'Profile updated successfully',
            'status' => true,
            'data' => $profile,
        ], 200);
    }
}
