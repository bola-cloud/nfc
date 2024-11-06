<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\ProfileLink;
use Illuminate\Http\Request;

class ProfileLinkController extends Controller
{
    /**
     * Display a listing of the profile links.
     */
    public function index()
    {
        $links = ProfileLink::with('profile.user')->get();  // Load profile links with profile and user relationship
        return view('admin.profile_links.index', compact('links'));
    }

    /**
     * Show the form for creating a new profile link.
     */
    public function create()
    {
        $profiles = Profile::with('user')->get();  // Get all profiles with users
        return view('admin.profile_links.create', compact('profiles'));
    }

    /**
     * Store a newly created profile link in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'type' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'url' => 'required|url',
        ]);

        ProfileLink::create($request->all());

        return redirect()->route('admin.profile_links.index')->with('success', __('lang.link_created_successfully'));
    }

    /**
     * Show the form for editing the specified profile link.
     */
    public function edit(ProfileLink $profileLink)
    {
        $profiles = Profile::with('user')->get();
        return view('admin.profile_links.edit', compact('profileLink', 'profiles'));
    }

    /**
     * Update the specified profile link in storage.
     */
    public function update(Request $request, ProfileLink $profileLink)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'type' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'url' => 'required|url',
        ]);

        $profileLink->update($request->all());

        return redirect()->route('admin.profile_links.index')->with('success', __('lang.link_updated_successfully'));
    }

    /**
     * Remove the specified profile link from storage.
     */
    public function destroy(ProfileLink $profileLink)
    {
        $profileLink->delete();

        return redirect()->route('admin.profile_links.index')->with('success', __('lang.link_deleted_successfully'));
    }
}
