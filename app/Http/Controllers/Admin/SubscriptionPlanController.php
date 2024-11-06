<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the subscription plans.
     */
    public function index()
    {
        $plans = SubscriptionPlan::all();
        return view('admin.subscription_plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new subscription plan.
     */
    public function create()
    {
        return view('admin.subscription_plans.create');
    }

    /**
     * Store a newly created subscription plan in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'link_limit' => 'required|integer|min:1',
        ]);

        SubscriptionPlan::create($request->all());

        return redirect()->route('admin.subscription_plans.index')
            ->with('success', __('lang.plan_created_successfully'));
    }

    /**
     * Show the form for editing the specified subscription plan.
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return view('admin.subscription_plans.edit', compact('subscriptionPlan'));
    }

    /**
     * Update the specified subscription plan in storage.
     */
    public function update(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'link_limit' => 'required|integer|min:1',
        ]);

        $subscriptionPlan->update($request->all());

        return redirect()->route('admin.subscription_plans.index')
            ->with('success', __('lang.plan_updated_successfully'));
    }

    /**
     * Remove the specified subscription plan from storage.
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();

        return redirect()->route('admin.subscription_plans.index')
            ->with('success', __('lang.plan_deleted_successfully'));
    }
}
