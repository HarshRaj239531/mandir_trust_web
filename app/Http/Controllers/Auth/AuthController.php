<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Show Devotee Registration Form.
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('devotee.profile');
        }

        return view('auth.register');
    }

    /**
     * Handle Devotee Registration Request with all 10 fields.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
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
            
            // 6. Gmail / Email (Admin editable only later)
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            
            // 7. Mobile Number (Devotee & Admin editable)
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 8. WhatsApp Number (Devotee & Admin editable)
            'whatsapp_number' => ['nullable', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 9. Pincode (Devotee & Admin editable)
            'pincode' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
            
            // 10. Selfie / Profile Picture (Devotee updatable anytime)
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            
            // Password
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Devotee Real Name is mandatory.',
            'nickname.required' => 'Nick Name / Spiritual Handle is mandatory (visible to other devotees).',
            'mother_name.required' => "Mother's Name is mandatory for sacred records.",
            'gender.required' => 'Please select gender.',
            'dob.required' => 'Date of Birth is mandatory.',
            'dob.before' => 'Date of Birth must be in the past.',
            'email.required' => 'Gmail / Email address is mandatory.',
            'email.unique' => 'This Gmail / Email is already registered with Shringi Rishi Mandir.',
            'mobile_number.required' => '10-digit Mobile number is mandatory.',
            'mobile_number.regex' => 'Please enter a valid 10-15 digit mobile number.',
            'whatsapp_number.regex' => 'Please enter a valid 10-15 digit WhatsApp number.',
            'pincode.required' => '6-digit Area Pincode is mandatory.',
            'pincode.regex' => 'Pincode must be exactly 6 digits.',
            'profile_photo.image' => 'Selfie / File must be an image file (JPG, PNG, WEBP).',
            'profile_photo.max' => 'Selfie photo size must not exceed 5MB.',
            'password.required' => 'Please create a secure password.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Handle Profile Photo / Selfie Upload
        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('devotees', 'public');
        }

        // If WhatsApp number wasn't specified, default to mobile number if user desires or leave as provided
        $whatsappNumber = $validated['whatsapp_number'] ?? $validated['mobile_number'];

        // Create User
        $user = User::create([
            'name' => $validated['name'],
            'nickname' => $validated['nickname'],
            'mother_name' => $validated['mother_name'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'email' => $validated['email'],
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

        return redirect()->route('devotee.profile')->with('success', '॥ हर हर महादेव ॥ Welcome to Shringi Rishi Mandir Trust! Your Devotee Registration has been completed successfully.');
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
     * Handle Devotee Login Request.
     */
    public function login(Request $request)
    {
        $loginInput = $request->input('login') ?? $request->input('email') ?? $request->input('mobile_number');
        $request->merge(['login' => $loginInput]);

        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Please enter your registered Gmail/Email or Mobile Number.',
            'password.required' => 'Please enter your password.',
        ]);

        $loginInput = $credentials['login'];
        $password = $credentials['password'];
        $remember = $request->boolean('remember');

        // Determine if login is email or mobile number
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile_number';

        if (Auth::attempt([$fieldType => $loginInput, 'password' => $password], $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['login' => 'Your account is deactivated. Please contact Mandir Trust Administration.'])->onlyInput('login');
            }

            // If Admin, redirect straight to Mandir Admin Portal
            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'))->with('success', '॥ ॐ नमः शिवाय ॥ Welcome to Mandir Admin Portal, ' . (Auth::user()->nickname ?: Auth::user()->name) . '!');
            }

            return redirect()->intended(route('devotee.profile'))->with('success', '॥ ॐ नमः शिवाय ॥ Welcome back, ' . Auth::user()->nickname . '!');
        }

        return back()->withErrors([
            'login' => 'Invalid credentials. Please verify your Email/Mobile number and password.',
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
