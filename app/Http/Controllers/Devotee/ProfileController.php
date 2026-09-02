<?php

namespace App\Http\Controllers\Devotee;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display Devotee Profile / Account Dashboard.
     */
    public function show()
    {
        $user = Auth::user();
        return view('devotee.profile', compact('user'));
    }

    /**
     * Update Devotee Editable Information (Nickname, Mobile, WhatsApp, Pincode, Selfie).
     * Note: Real Name, Mother's Name, Gender, DOB, and Gmail CANNOT be updated by user.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            // 2. Nick Name (Devotee choice)
            'nickname' => ['required', 'string', 'max:100'],
            
            // 7. Mobile Number
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 8. WhatsApp Number
            'whatsapp_number' => ['nullable', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 9. Pincode
            'pincode' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
            
            // 10. Selfie / Profile Picture (Time to time updatable)
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,jfif,avif,gif', 'max:5120'],
            'profile_photo_base64' => ['nullable', 'string'],
            
            // Optional Password Update
            'current_password' => ['nullable', 'required_with:new_password', 'string'],
            'new_password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'nickname.required' => 'Nick Name is required.',
            'mobile_number.required' => 'Mobile number is required.',
            'mobile_number.regex' => 'Please enter a valid 10-15 digit mobile number.',
            'whatsapp_number.regex' => 'Please enter a valid 10-15 digit WhatsApp number.',
            'pincode.required' => 'Pincode is required.',
            'pincode.regex' => 'Pincode must be exactly 6 digits.',
            'profile_photo.uploaded' => 'Profile photo could not be uploaded. Please choose an image under 10MB.',
            'profile_photo.image' => 'Profile photo must be a valid image file.',
            'profile_photo.max' => 'Profile photo file size must not exceed 5MB.',
            'new_password.min' => 'New password must be at least 6 characters long.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        // Check current password if attempting to update password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match our records.'])->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }

        // Handle Profile Photo / Selfie Update (Base64 canvas compressed or multipart file)
        if ($request->filled('profile_photo_base64')) {
            if ($user->profile_photo) {
                ImageHelper::delete($user->profile_photo);
            }
            $user->profile_photo = ImageHelper::processAndStoreBase64($request->input('profile_photo_base64'), 'devotees');
        } elseif ($request->hasFile('profile_photo')) {
            // Delete old photo
            if ($user->profile_photo) {
                ImageHelper::delete($user->profile_photo);
            }
            $user->profile_photo = ImageHelper::processAndStore($request->file('profile_photo'), 'devotees');
        }

        // Update ONLY allowed fields
        $user->nickname = $validated['nickname'];
        $user->mobile_number = $validated['mobile_number'];
        $user->whatsapp_number = $validated['whatsapp_number'] ?? $validated['mobile_number'];
        $user->pincode = $validated['pincode'];
        
        $user->save();

        return redirect()->route('devotee.profile')->with('success', '॥ शुभम् ॥ Your Devotee Profile and Selfie have been updated successfully!');
    }
}
