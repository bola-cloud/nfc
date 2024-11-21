<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileLinkController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected Routes (Require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('profile', [ProfileController::class, 'show']);
    Route::post('/add/profile', [ProfileController::class, 'update']);
    Route::get('/profile-links', [ProfileLinkController::class, 'getLinks']);
    // Add a new link for the authenticated user
    Route::post('/add/profile-link', [ProfileLinkController::class, 'addLink']);
    // Logout route
    Route::post('logout', [AuthController::class, 'logout']);
});