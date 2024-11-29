<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.pages.admin_profile', compact('adminData'));
    }


    public function update(Request $request, $id)
{
    $admin = User::findOrFail($id);

    // Validate request data
    $validatedData = $request->validate([
        'username' => 'nullable|string|max:255',
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
    ]);

    // Update fields if present
    $admin->fill($validatedData);

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($admin->image) {
            Storage::delete('public/' . $admin->image);
        }

        // Get the user's full name and sanitize it for use as a file name
        // Change full_name to name or your specific field if needed
        $fullName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $admin->name);

        // Get the original extension of the uploaded image
        $extension = $request->file('image')->getClientOriginalExtension();

        // Create a new file name using the user's full name and the extension
        $fileName = $fullName . '.' . $extension;

        // Store the new image in a profiles folder with the custom file name
        $imagePath = $request->file('image')->storeAs('profiles', $fileName, 'public');

        // Save the relative path to the database
        $admin->image = $imagePath;
    }

    // Save the updated user data
    $admin->save();

    return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
}

}
