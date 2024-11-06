<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with('subscriptionPlan')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $plans = SubscriptionPlan::all();  // Get all subscription plans for selection
        return view('admin.users.create', compact('plans'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users',
            'category' => 'required|in:admin,user,technical',
            'password' => 'required|string|min:8|confirmed',
            'subscription_plan_id' => 'nullable|exists:subscription_plans,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'category' => $request->category,
            'password' => Hash::make($request->password),
            'subscription_plan_id' => $request->subscription_plan_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', __('lang.user_created_successfully'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $plans = SubscriptionPlan::all();
        return view('admin.users.edit', compact('user', 'plans'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'category' => 'required|in:admin,user,technical',
            'password' => 'nullable|string|min:8|confirmed',
            'subscription_plan_id' => 'nullable|exists:subscription_plans,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'category' => $request->category,
            'subscription_plan_id' => $request->subscription_plan_id,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', __('lang.user_updated_successfully'));
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('lang.user_deleted_successfully'));
    }
}
