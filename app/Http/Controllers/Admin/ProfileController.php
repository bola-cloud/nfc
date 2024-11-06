<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of profiles.
     */
    public function index()
    {
        $profiles = Profile::with('user')->get();  // Load profiles with user relationship
        return view('admin.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new profile.
     */
    public function create()
    {
        $users = User::doesntHave('profile')->get();  // Get users without profiles
        return view('admin.profiles.create', compact('users'));
    }

    /**
     * Store a newly created profile in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:profiles,user_id',
            'bio' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max size
            'company' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ]);
    
        $data = $request->all();
    
        // Handle file upload
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $this->storeImage($request->file('profile_image'));
        }
    
        Profile::create($data);
    
        return redirect()->route('admin.profiles.index')->with('success', __('lang.profile_created_successfully'));
    }

    /**
     * Show the form for editing the specified profile.
     */
    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified profile in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'bio' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'company' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ]);
    
        $data = $request->all();
    
        // Handle profile image update
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $this->storeImage($request->file('profile_image'));
        }
    
        $profile->update($data);
    
        return redirect()->route('admin.profiles.index')->with('success', __('lang.profile_updated_successfully'));
    }

    protected function storeImage($image)
    {
        // Define the storage path for profile images
        $path = $image->store('profiles', 'public'); // Save image in the 'storage/app/public/profiles' folder

        // Optionally, generate a thumbnail here if needed (requires an image processing library)
        
        return $path;
    }


    /**
     * Remove the specified profile from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', __('lang.profile_deleted_successfully'));
    }
}
