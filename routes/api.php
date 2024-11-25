<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileLinkController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ContactController;

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
    Route::get('/profile/qr/{id}', [ProfileController::class, 'generateQrCode']);
    Route::post('/add/profile', [ProfileController::class, 'update']);
    Route::get('/profile-links', [ProfileLinkController::class, 'getLinks']);
    // Add a new link for the authenticated user
    Route::post('/add/profile-link', [ProfileLinkController::class, 'addLink']);
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

    Route::get('/products', [ProductController::class, 'index']);
    // Logout route
    Route::post('logout', [AuthController::class, 'logout']);
});