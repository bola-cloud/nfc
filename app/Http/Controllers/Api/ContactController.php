<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Fetch all contacts for the authenticated user
        $contacts = Auth::user()->contacts;

        return response()->json([
            'message' => 'Contacts retrieved successfully.',
            'status' => true,
            'data' => $contacts,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'job' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $contact = Auth::user()->contacts()->create($data);

        return response()->json([
            'message' => 'Contact created successfully.',
            'status' => true,
            'data' => $contact,
        ]);
    }
}
