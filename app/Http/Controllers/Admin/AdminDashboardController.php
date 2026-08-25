<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            
            // Administrative fields
            'status' => ['required', 'string', Rule::in(['active', 'inactive'])],
            'is_admin' => ['nullable', 'boolean'],
            'new_password' => ['nullable', 'string', 'min:6'],
        ]);

        // Handle Profile Photo / Selfie Update
        if ($request->hasFile('profile_photo')) {
            if ($devotee->profile_photo && Storage::disk('public')->exists($devotee->profile_photo)) {
                Storage::disk('public')->delete($devotee->profile_photo);
            }
            $devotee->profile_photo = $request->file('profile_photo')->store('devotees', 'public');
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

        if ($devotee->profile_photo && Storage::disk('public')->exists($devotee->profile_photo)) {
            Storage::disk('public')->delete($devotee->profile_photo);
        }

        $devotee->delete();

        return redirect()->route('admin.devotees.index')->with('success', "Devotee record removed successfully.");
    }
}
