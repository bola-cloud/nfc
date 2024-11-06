<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Analytics;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the analytics logs.
     */
    public function index()
    {
        $analytics = Analytics::with('nfcTag.user')->get();  // Load analytics with NFC tags and related users
        return view('admin.analytics.index', compact('analytics'));
    }

    /**
     * Show the details of a specific analytics log.
     */
    public function show(Analytics $analytics)
    {
        return view('admin.analytics.show', compact('analytics'));
    }

    /**
     * Remove the specified analytics log from storage.
     */
    public function destroy(Analytics $analytics)
    {
        $analytics->delete();

        return redirect()->route('admin.analytics.index')->with('success', __('lang.analytics_deleted_successfully'));
    }
}
