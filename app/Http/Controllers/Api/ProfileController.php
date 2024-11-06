<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // GET Profile
    public function show()
    {
        $profile = Auth::user()->profile;

        if (!$profile) {
            return response()->json([
                'message' => 'Profile not found',
                'status' => false,
                'data' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Profile retrieved successfully',
            'status' => true,
            'data' => $profile,
        ], 200);
    }

    // POST/UPDATE Profile
    public function update(Request $request)
    {
        $data = $request->validate([
            'bio' => 'nullable|string',
            'website' => 'nullable|url',
            'profile_image' => 'nullable|string',
            'company' => 'nullable|string',
            'job_title' => 'nullable|string',
        ]);

        $user = Auth::user();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);

        $profile->fill($data);
        $profile->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'status' => true,
            'data' => $profile,
        ], 200);
    }
}
