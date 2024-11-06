<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NfcTag;
use App\Models\User;
use Illuminate\Http\Request;

class NfcTagController extends Controller
{
    /**
     * Display a listing of the NFC tags.
     */
    public function index()
    {
        $tags = NfcTag::with('user')->get();  // Load NFC tags with the associated user
        return view('admin.nfc_tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new NFC tag.
     */
    public function create()
    {
        $users = User::all();  // Get all users for NFC tag assignment
        return view('admin.nfc_tags.create', compact('users'));
    }

    /**
     * Store a newly created NFC tag in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag_id' => 'required|string|unique:nfc_tags,tag_id',
            'user_id' => 'required|exists:users,id',  // Ensure user exists
        ]);

        NfcTag::create($request->all());

        return redirect()->route('admin.nfc_tags.index')->with('success', __('lang.tag_created_successfully'));
    }

    /**
     * Show the form for editing the specified NFC tag.
     */
    public function edit(NfcTag $nfcTag)
    {
        $users = User::all();
        return view('admin.nfc_tags.edit', compact('nfcTag', 'users'));
    }

    /**
     * Update the specified NFC tag in storage.
     */
    public function update(Request $request, NfcTag $nfcTag)
    {
        $request->validate([
            'tag_id' => 'required|string|unique:nfc_tags,tag_id,' . $nfcTag->id,
            'user_id' => 'required|exists:users,id',
        ]);

        $nfcTag->update($request->all());

        return redirect()->route('admin.nfc_tags.index')->with('success', __('lang.tag_updated_successfully'));
    }

    /**
     * Remove the specified NFC tag from storage.
     */
    public function destroy(NfcTag $nfcTag)
    {
        $nfcTag->delete();

        return redirect()->route('admin.nfc_tags.index')->with('success', __('lang.tag_deleted_successfully'));
    }
    
    public function checkTagIdUnique($tag_id)
    {
        $exists = NfcTag::where('tag_id', $tag_id)->exists();
        return response()->json(['unique' => !$exists]);
    }
}
