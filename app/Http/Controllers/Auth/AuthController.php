<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Show Devotee Registration Form.
     */
    public function showRegisterForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('devotee.profile');
        }

        $referralCode = strtoupper(trim((string) $request->query('ref', '')));
        $initialSponsor = null;
        if (!empty($referralCode)) {
            $initialSponsor = User::where('member_id', $referralCode)->first();
        }

        return view('auth.register', compact('referralCode', 'initialSponsor'));
    }

    /**
     * Verify Sponsor ID before registration (Live AJAX / JSON endpoint).
     * Devotee enters only Sponsor ID -> system returns Sponsor Name.
     */
    public function verifySponsor(Request $request)
    {
        $sponsorCode = strtoupper(trim((string) $request->input('sponsor_id', $request->input('ref', ''))));

        if (empty($sponsorCode)) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid Sponsor ID (e.g. DS101010101010).',
            ], 422);
        }

        $sponsor = User::where('member_id', $sponsorCode)->first();

        if (!$sponsor) {
            return response()->json([
                'success' => false,
                'message' => "Sponsor ID '{$sponsorCode}' not found. Please verify the ID with your sponsor.",
            ], 404);
        }

        if ($sponsor->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => "Sponsor account '{$sponsorCode}' is inactive. Please contact Mandir Administration.",
            ], 422);
        }

        return response()->json([
            'success' => true,
            'sponsor' => [
                'id' => $sponsor->id,
                'member_id' => $sponsor->member_id,
                'name' => $sponsor->name,
                'nickname' => $sponsor->nickname,
                'profile_photo_url' => $sponsor->profile_photo_url,
            ],
            'message' => "Sponsor verified: {$sponsor->name}",
        ]);
    }

    /**
     * Handle Devotee Registration Request with all 10 fields and Mandatory Sponsor.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            // Mandatory Sponsor ID
            'sponsor_member_id' => ['required', 'string', 'exists:users,member_id'],

            // 1. Real Name (Private, only in user account & admin panel)
            'name' => ['required', 'string', 'max:255'],
            
            // 2. Nick Name (Publicly visible to other devotees)
            'nickname' => ['required', 'string', 'max:100'],
            
            // 3. Mother's Name (Admin editable only later)
            'mother_name' => ['required', 'string', 'max:255'],
            
            // 4. Gender (Admin editable only later)
            'gender' => ['required', 'string', Rule::in(['male', 'female', 'other'])],
            
            // 5. Date of Birth (Admin editable only later)
            'dob' => ['required', 'date', 'before:today'],
            
            // 6. Gmail / Email (Optional)
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email'],
            
            // 7. Mobile Number (Admin editable later)
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 8. WhatsApp Number (Admin editable later)
            'whatsapp_number' => ['nullable', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 9. Pincode (Admin editable later)
            'pincode' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
            
            // 10. Selfie / Profile Picture (Devotee updatable anytime)
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,jfif,avif,gif', 'max:5120'],
            'profile_photo_base64' => ['nullable', 'string'],
            
            // Password
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'sponsor_member_id.required' => 'Sponsor ID is mandatory before registration. Please enter and confirm your Sponsor.',
            'sponsor_member_id.exists' => 'The entered Sponsor ID is invalid or does not exist.',
            'name.required' => 'Devotee Real Name is mandatory.',
            'nickname.required' => 'Nick Name / Display Name is mandatory (visible to other devotees).',
            'mother_name.required' => "Mother's Name is mandatory for sacred records.",
            'gender.required' => 'Please select gender.',
            'dob.required' => 'Date of Birth is mandatory.',
            'dob.before' => 'Date of Birth must be in the past.',
            'email.unique' => 'This Gmail / Email is already registered with Shringi Rishi Mandir.',
            'mobile_number.required' => '10-digit Mobile number is mandatory.',
            'mobile_number.regex' => 'Please enter a valid 10-15 digit mobile number.',
            'whatsapp_number.regex' => 'Please enter a valid 10-15 digit WhatsApp number.',
            'pincode.required' => '6-digit Area Pincode is mandatory.',
            'pincode.regex' => 'Pincode must be exactly 6 digits.',
            'profile_photo.uploaded' => 'Profile photo failed to upload. The selected image might exceed server upload size. Please choose an image under 10MB.',
            'profile_photo.image' => 'Profile photo must be a valid image file (JPG, PNG, WEBP).',
            'profile_photo.max' => 'Profile photo size must not exceed 5MB.',
            'password.required' => 'Please create a secure password.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Find and verify sponsor
        $sponsor = User::where('member_id', strtoupper(trim($validated['sponsor_member_id'])))->first();
        if (!$sponsor || $sponsor->status !== 'active') {
            return back()->withErrors(['sponsor_member_id' => 'The selected Sponsor account is not active or invalid.'])->withInput();
        }

        // Handle Profile Photo / Selfie Upload (Base64 canvas compressed or multipart file)
        $photoPath = null;
        if ($request->filled('profile_photo_base64')) {
            $photoPath = ImageHelper::processAndStoreBase64($request->input('profile_photo_base64'), 'devotees');
        } elseif ($request->hasFile('profile_photo')) {
            $photoPath = ImageHelper::processAndStore($request->file('profile_photo'), 'devotees');
        }

        // If WhatsApp number wasn't specified, default to mobile number
        $whatsappNumber = $validated['whatsapp_number'] ?? $validated['mobile_number'];

        // Generate unique 12-digit Member ID with DS prefix (e.g. DS123456789012)
        $memberId = User::generateMemberId();

        // Create User
        $user = User::create([
            'member_id' => $memberId,
            'sponsor_id' => $sponsor->id,
            'name' => $validated['name'],
            'nickname' => $validated['nickname'],
            'mother_name' => $validated['mother_name'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'email' => !empty($validated['email']) ? $validated['email'] : null,
            'mobile_number' => $validated['mobile_number'],
            'whatsapp_number' => $whatsappNumber,
            'pincode' => $validated['pincode'],
            'profile_photo' => $photoPath,
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
            'status' => 'active',
        ]);

        // Log the devotee in
        Auth::login($user);

        return redirect()->route('devotee.profile')->with('success', "॥ हर हर महादेव ॥ Registration successful! Your Login Member ID is: {$user->member_id}. Keep it safe for future login.");
    }

    /**
     * Show Devotee Login Form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('devotee.profile');
        }

        return view('auth.login');
    }

    /**
     * Handle Devotee Login Request using Member ID (DS...) / Email / Mobile and password.
     */
    public function login(Request $request)
    {
        $loginInput = trim((string) ($request->input('login') ?? $request->input('member_id') ?? $request->input('email') ?? $request->input('mobile_number') ?? ''));
        $request->merge(['login' => $loginInput]);

        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Please enter your Member ID (e.g. DS826730159463).',
            'password.required' => 'Please enter your password.',
        ]);

        $loginInput = $credentials['login'];
        $password = $credentials['password'];
        $remember = $request->boolean('remember');

        // Look up devotee by Member ID (case-insensitive e.g. DS...), email or mobile number
        $user = User::where('member_id', strtoupper($loginInput))
            ->orWhere('email', $loginInput)
            ->orWhere('mobile_number', $loginInput)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            if ($user->status !== 'active') {
                return back()->withErrors(['login' => 'Your account is deactivated. Please contact Mandir Trust Administration.'])->onlyInput('login');
            }

            Auth::login($user, $remember);
            $request->session()->regenerate();

            // If Admin, redirect straight to Mandir Admin Portal
            if ($user->is_admin) {
                return redirect()->intended(route('admin.dashboard'))->with('success', '॥ ॐ नमः शिवाय ॥ Welcome to Mandir Admin Portal, ' . ($user->nickname ?: $user->name) . '!');
            }

            return redirect()->intended(route('devotee.profile'))->with('success', '॥ ॐ नमः शिवाय ॥ Welcome back, ' . $user->nickname . '!');
        }

        return back()->withErrors([
            'login' => 'Invalid Member ID or password. Please verify your ID (e.g. DS826730159463) and password.',
        ])->onlyInput('login');
    }

    /**
     * Handle Devotee Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been successfully logged out from Shringi Rishi Mandir Trust.');
    }
}
