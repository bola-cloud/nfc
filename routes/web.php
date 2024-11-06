<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([
    'prefix' => LaravelLocalization::setLocale(), // Set the language prefix correctly
    'middleware' => [
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ],
    'as' => "admin.", // Use 'as' instead of 'name'
    'namespace'=>'\App\Http\Controllers\Admin',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('subscription_plans', SubscriptionPlanController::class);
    Route::resource('users', UserController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('nfc_tags', NfcTagController::class);
    Route::get('nfc_tags/check/{tag_id}', [NfcTagController::class, 'checkTagIdUnique'])->name('nfc_tags.check');
    Route::resource('analytics', AnalyticsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('profile_links', ProfileLinkController::class);
    Route::resource('audit_logs', AuditLogController::class)->only(['index', 'show']);

});