<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileLink;

class ProfileLinkController extends Controller
{
    public function getLinks()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Fetch the user's profile
        $profile = $user->profile;

        // Return the links associated with the profile
        if ($profile) {
            $links = $profile->links()->get();
            return response()->json(['links' => $links], 200);
        }

        return response()->json(['message' => 'Profile not found.'], 404);
    }

    public function addLink(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Fetch the user's profile
        $profile = $user->profile;

        if ($profile) {
            // Add the new link
            $link = $profile->links()->create([
                'type' => $validated['type'],
                'label' => $validated['label'],
                'url' => $validated['url'],
            ]);

            return response()->json(['message' => 'Link added successfully.', 'link' => $link], 201);
        }

        return response()->json(['message' => 'Profile not found.'], 404);
    }
}
