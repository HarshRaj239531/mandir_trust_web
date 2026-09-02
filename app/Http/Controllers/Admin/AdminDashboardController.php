<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Analytics & Summary Dashboard.
     */
    public function dashboard()
    {
        // Core Statistics
        $totalDevotees = User::where('is_admin', false)->count();
        $totalAdmins = User::where('is_admin', true)->count();
        $maleDevotees = User::where('is_admin', false)->where('gender', 'male')->count();
        $femaleDevotees = User::where('is_admin', false)->where('gender', 'female')->count();
        $otherDevotees = User::where('is_admin', false)->where('gender', 'other')->count();
        $recentDevoteesCount = User::where('is_admin', false)->where('created_at', '>=', now()->subDays(7))->count();
        $activeDevotees = User::where('is_admin', false)->where('status', 'active')->count();

        // Recent 6 Enrollments for dashboard stream
        $recentDevotees = User::where('is_admin', false)->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalDevotees',
            'totalAdmins',
            'maleDevotees',
            'femaleDevotees',
            'otherDevotees',
            'recentDevoteesCount',
            'activeDevotees',
            'recentDevotees'
        ));
    }

    /**
     * Display the Dedicated Registered Users / Devotees Page.
     */
    public function devotees(Request $request)
    {
        $query = User::query();

        // Search filter (Name, Nickname, Email, Mobile, Pincode, Mother's Name)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nickname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('pincode', 'like', "%{$search}%")
                  ->orWhere('mother_name', 'like', "%{$search}%");
            });
        }

        // Gender filter
        if ($gender = $request->input('gender')) {
            $query->where('gender', $gender);
        }

        // Status filter
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Role filter
        if ($request->has('is_admin') && $request->input('is_admin') !== '') {
            $query->where('is_admin', (bool) $request->input('is_admin'));
        }

        $devotees = $query->latest()->paginate(15)->withQueryString();

        // Summary counts for filter pills
        $totalCount = User::where('is_admin', false)->count();
        $activeCount = User::where('is_admin', false)->where('status', 'active')->count();
        $inactiveCount = User::where('is_admin', false)->where('status', 'inactive')->count();

        return view('admin.devotees.index', compact(
            'devotees',
            'totalCount',
            'activeCount',
            'inactiveCount'
        ));
    }

    /**
     * Show the edit form for a devotee (Admin has full edit rights over all fields including locked ones).
     */
    public function editUser($id)
    {
        $devotee = User::findOrFail($id);
        return view('admin.edit-devotee', compact('devotee'));
    }

    /**
     * Update any devotee details from the Admin Panel (Full Admin Privilege).
     */
    public function updateUser(Request $request, $id)
    {
        $devotee = User::findOrFail($id);

        $validated = $request->validate([
            // 1. Real Name (Admin editable)
            'name' => ['required', 'string', 'max:255'],
            
            // 2. Nick Name (Admin editable)
            'nickname' => ['required', 'string', 'max:100'],
            
            // 3. Mother's Name (Admin editable)
            'mother_name' => ['required', 'string', 'max:255'],
            
            // 4. Gender (Admin editable)
            'gender' => ['required', 'string', Rule::in(['male', 'female', 'other'])],
            
            // 5. Date of Birth (Admin editable)
            'dob' => ['required', 'date', 'before:today'],
            
            // 6. Gmail / Email (Admin editable)
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($devotee->id)],
            
            // 7. Mobile Number (Admin editable)
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 8. WhatsApp Number (Admin editable)
            'whatsapp_number' => ['nullable', 'string', 'regex:/^[0-9]{10,15}$/'],
            
            // 9. Pincode (Admin editable)
            'pincode' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
            
            // 10. Selfie / Profile Picture
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,jfif,avif,gif', 'max:5120'],
            'profile_photo_base64' => ['nullable', 'string'],
            
            // Administrative fields
            'status' => ['required', 'string', Rule::in(['active', 'inactive'])],
            'is_admin' => ['nullable', 'boolean'],
            'new_password' => ['nullable', 'string', 'min:6'],
        ]);

        // Handle Profile Photo / Selfie Update (Base64 canvas compressed or multipart file)
        if ($request->filled('profile_photo_base64')) {
            if ($devotee->profile_photo) {
                ImageHelper::delete($devotee->profile_photo);
            }
            $devotee->profile_photo = ImageHelper::processAndStoreBase64($request->input('profile_photo_base64'), 'devotees');
        } elseif ($request->hasFile('profile_photo')) {
            if ($devotee->profile_photo) {
                ImageHelper::delete($devotee->profile_photo);
            }
            $devotee->profile_photo = ImageHelper::processAndStore($request->file('profile_photo'), 'devotees');
        }

        // Update all 10 fields
        $devotee->name = $validated['name'];
        $devotee->nickname = $validated['nickname'];
        $devotee->mother_name = $validated['mother_name'];
        $devotee->gender = $validated['gender'];
        $devotee->dob = $validated['dob'];
        $devotee->email = $validated['email'];
        $devotee->mobile_number = $validated['mobile_number'];
        $devotee->whatsapp_number = $validated['whatsapp_number'] ?? $validated['mobile_number'];
        $devotee->pincode = $validated['pincode'];
        $devotee->status = $validated['status'];
        
        if ($request->has('is_admin')) {
            $devotee->is_admin = $request->boolean('is_admin');
        }

        if ($request->filled('new_password')) {
            $devotee->password = Hash::make($request->new_password);
        }

        $devotee->save();

        return redirect()->route('admin.devotees.index')->with('success', "Devotee records for '{$devotee->nickname}' ({$devotee->name}) updated successfully.");
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus($id)
    {
        $devotee = User::findOrFail($id);
        $devotee->status = ($devotee->status === 'active') ? 'inactive' : 'active';
        $devotee->save();

        return back()->with('success', "Status for '{$devotee->nickname}' updated to {$devotee->status}.");
    }

    /**
     * Delete a devotee record.
     */
    public function deleteUser($id)
    {
        $devotee = User::findOrFail($id);
        
        // Prevent deleting the primary logged-in admin
        if ($devotee->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own Administrator account.');
        }

        if ($devotee->profile_photo) {
            ImageHelper::delete($devotee->profile_photo);
        }

        $devotee->delete();

        return redirect()->route('admin.devotees.index')->with('success', "Devotee record removed successfully.");
    }

    /**
     * Display Poojas & Sevas admin overview (from MySQL).
     */
    public function poojas()
    {
        $poojas = \App\Models\Pooja::withCount('bookings')->latest()->get();
        $totalBookings = \App\Models\PoojaBooking::count();
        $activePoojasCount = \App\Models\Pooja::where('is_active', true)->count();
        $recentBookings = \App\Models\PoojaBooking::latest()->take(10)->get();

        return view('admin.poojas', compact('poojas', 'totalBookings', 'activePoojasCount', 'recentBookings'));
    }

    /**
     * Store a newly created Pooja in MySQL.
     */
    public function storePooja(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'deity' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'dakshina' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'string', 'max:100'],
            'timing' => ['required', 'string', 'max:100'],
            'priest' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'inclusions' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = ImageHelper::processAndStore($request->file('image'), 'poojas');
        }

        \App\Models\Pooja::create($validated);

        return back()->with('success', 'Pooja offering created and published to MySQL database.');
    }

    /**
     * Delete a Pooja from MySQL.
     */
    public function deletePooja($id)
    {
        $pooja = \App\Models\Pooja::findOrFail($id);
        if ($pooja->image) {
            ImageHelper::delete($pooja->image);
        }
        $pooja->delete();

        return back()->with('success', 'Pooja deleted successfully.');
    }

    /**
     * Display Daan & Donations admin overview (from MySQL).
     */
    public function donations()
    {
        $donations = \App\Models\Donation::latest()->paginate(15);
        $totalDonationAmount = \App\Models\Donation::sum('amount');
        $totalDonationsCount = \App\Models\Donation::count();
        $annakshetraDonations = \App\Models\Donation::where('seva_cause', 'like', '%Annadanam%')->sum('amount');
        $gaushalaDonations = \App\Models\Donation::where('seva_cause', 'like', '%Gau%')->sum('amount');

        return view('admin.donations', compact(
            'donations',
            'totalDonationAmount',
            'totalDonationsCount',
            'annakshetraDonations',
            'gaushalaDonations'
        ));
    }

    /**
     * Store manual Donation receipt in MySQL.
     */
    public function storeDonation(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'donor_mobile' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            'donor_email' => ['nullable', 'email'],
            'donor_pan' => ['nullable', 'string', 'max:20'],
            'cause' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_mode' => ['required', 'string'],
            'transaction_id' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'status' => ['required', 'string'],
        ]);

        if (empty($validated['transaction_id'])) {
            $validated['transaction_id'] = 'TXN-' . strtoupper(uniqid());
        }

        \App\Models\Donation::create($validated);

        return back()->with('success', 'Donation receipt recorded successfully in database.');
    }

    /**
     * Delete a donation record from database.
     */
    public function deleteDonation($id)
    {
        $donation = \App\Models\Donation::findOrFail($id);
        $donation->delete();

        return back()->with('success', 'Donation record deleted from database.');
    }

    /**
     * Display Temple Events admin overview (from MySQL).
     */
    public function events()
    {
        $events = \App\Models\TempleEvent::latest()->get();
        return view('admin.events', compact('events'));
    }

    /**
     * Store a new Temple Festival / Utsav in MySQL.
     */
    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'event_date' => ['required', 'string', 'max:100'],
            'timings' => ['nullable', 'string', 'max:100'],
            'expected_crowd' => ['required', 'string', 'max:100'],
            'coordinator' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = ImageHelper::processAndStore($request->file('image'), 'events');
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . rand(100, 999);

        \App\Models\TempleEvent::create($validated);

        return back()->with('success', 'Event added and published to MySQL database.');
    }

    /**
     * Delete an event.
     */
    public function deleteEvent($id)
    {
        $event = \App\Models\TempleEvent::findOrFail($id);
        if ($event->image) {
            ImageHelper::delete($event->image);
        }
        $event->delete();

        return back()->with('success', 'Event deleted from database.');
    }

    /**
     * Display Temple Facilities admin overview (from MySQL).
     */
    public function facilities()
    {
        $facilities = \App\Models\Facility::latest()->get();
        return view('admin.facilities', compact('facilities'));
    }

    /**
     * Store a new Temple Facility in MySQL.
     */
    public function storeFacility(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'string', 'max:255'],
            'occupancy' => ['required', 'string', 'max:255'],
            'incharge' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = ImageHelper::processAndStore($request->file('image'), 'facilities');
        }

        \App\Models\Facility::create($validated);

        return back()->with('success', 'Facility registered in MySQL database.');
    }

    /**
     * Delete a facility.
     */
    public function deleteFacility($id)
    {
        $facility = \App\Models\Facility::findOrFail($id);
        if ($facility->image) {
            ImageHelper::delete($facility->image);
        }
        $facility->delete();

        return back()->with('success', 'Facility removed from database.');
    }

    /**
     * Display Gallery & Media admin overview (from MySQL).
     */
    public function gallery()
    {
        $galleries = \App\Models\Gallery::latest()->get();
        return view('admin.gallery', compact('galleries'));
    }

    /**
     * Upload and store a new photo in MySQL Gallery.
     */
    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'caption' => ['nullable', 'string'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif', 'max:12288'],
        ]);

        $path = ImageHelper::processAndStore($request->file('photo'), 'gallery');

        \App\Models\Gallery::create([
            'title' => $request->title,
            'category' => $request->category,
            'caption' => $request->caption,
            'image_path' => $path,
            'is_published' => true,
        ]);

        return back()->with('success', 'New Darshan Photo uploaded and stored in MySQL database.');
    }

    /**
     * Update an existing gallery photo in MySQL.
     */
    public function updateGallery(Request $request, $id)
    {
        $item = \App\Models\Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'caption' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif', 'max:12288'],
        ]);

        if ($request->hasFile('photo')) {
            // Delete old file if stored locally
            if ($item->image_path) {
                ImageHelper::delete($item->image_path);
            }
            $item->image_path = ImageHelper::processAndStore($request->file('photo'), 'gallery');
        }

        $item->title = $validated['title'];
        $item->category = $validated['category'];
        $item->caption = $validated['caption'];
        $item->save();

        return back()->with('success', 'Gallery photo details updated successfully.');
    }

    /**
     * Delete a gallery photo.
     */
    public function deleteGallery($id)
    {
        $item = \App\Models\Gallery::findOrFail($id);
        if ($item->image_path) {
            ImageHelper::delete($item->image_path);
        }
        $item->delete();

        return back()->with('success', 'Photo removed from MySQL database.');
    }

    /**
     * Display Admin Account Security & Settings page.
     */
    public function settings()
    {
        $admin = auth()->user();
        $homepageSettings = \App\Models\SiteSetting::where('group', 'homepage')->get()->keyBy('key');
        return view('admin.settings', compact('admin', 'homepageSettings'));
    }

    /**
     * Update Homepage Media Images (Hero & section photos) from Admin Settings.
     */
    public function updateHomepageMedia(Request $request)
    {
        $request->validate([
            'hero_mandir_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif', 'max:12288'],
            'about_history_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif', 'max:12288'],
            'live_darshan_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif', 'max:12288'],
            'goshala_seva_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif', 'max:12288'],
        ]);

        $imageKeys = [
            'hero_mandir_image',
            'about_history_image',
            'live_darshan_image',
            'goshala_seva_image',
        ];

        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                $setting = \App\Models\SiteSetting::where('key', $key)->first();
                if ($setting && $setting->value) {
                    ImageHelper::delete($setting->value);
                }

                $path = ImageHelper::processAndStore($request->file($key), 'settings');

                \App\Models\SiteSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path, 'type' => 'image', 'group' => 'homepage']
                );
            }
        }

        return back()->with('success', 'Home page images updated dynamically and published to database.');
    }

    /**
     * Update Admin Password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $admin = auth()->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', 'Admin Password has been updated securely.');
    }

    /**
     * Update Admin Profile details.
     */
    public function updateProfile(Request $request)
    {
        $admin = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($admin->id)],
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
        ]);

        $admin->update($validated);

        return back()->with('success', 'Admin Profile details updated successfully.');
    }
}

