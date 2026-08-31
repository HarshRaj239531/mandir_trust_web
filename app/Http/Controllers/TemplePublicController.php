<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Pooja;
use App\Models\PoojaBooking;
use App\Models\TempleEvent;
use Illuminate\Http\Request;

class TemplePublicController extends Controller
{
    /**
     * Welcome Home Page - Dynamic from MySQL
     */
    public function home()
    {
        $poojas = Pooja::where('is_active', true)->take(4)->get();
        $events = TempleEvent::latest()->take(3)->get();
        $galleries = Gallery::where('is_published', true)->latest()->take(6)->get();
        return view('welcome', compact('poojas', 'events', 'galleries'));
    }

    /**
     * Poojas Catalog Page
     */
    public function poojas()
    {
        $poojas = Pooja::where('is_active', true)->get();
        return view('poojas', compact('poojas'));
    }

    /**
     * Handle Public Devotee Pooja Sankalpa Booking
     */
    public function bookPooja(Request $request)
    {
        $validated = $request->validate([
            'pooja_id' => ['nullable', 'exists:poojas,id'],
            'pooja_name' => ['required', 'string', 'max:255'],
            'devotee_name' => ['required', 'string', 'max:255'],
            'gotra' => ['nullable', 'string', 'max:100'],
            'nakshatra' => ['nullable', 'string', 'max:100'],
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            'email' => ['nullable', 'email'],
            'amount' => ['nullable', 'numeric'],
        ]);

        $booking = PoojaBooking::create([
            'pooja_id' => $validated['pooja_id'] ?? null,
            'pooja_name' => $validated['pooja_name'],
            'devotee_name' => $validated['devotee_name'],
            'gotra' => $validated['gotra'] ?? null,
            'nakshatra' => $validated['nakshatra'] ?? null,
            'preferred_date' => $validated['preferred_date'],
            'mobile_number' => $validated['mobile_number'],
            'email' => $validated['email'] ?? null,
            'amount' => $validated['amount'] ?? 0,
            'status' => 'confirmed',
        ]);

        return back()->with('success', "॥ ॐ नमः शिवाय ॥ Your Pooja Sankalpa for '{$booking->pooja_name}' has been consecrated and booked successfully! Booking Ref #PB-{$booking->id}");
    }

    /**
     * Donate Page
     */
    public function donate()
    {
        return view('donate');
    }

    /**
     * Process Public Daan & Donation Submission
     */
    public function processDonation(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'pan_number' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'],
            'seva_cause' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:11'],
            'payment_mode' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        // Generate sequential unique Receipt Number
        $receiptNumber = 'DON-' . date('Y') . '-' . str_pad(Donation::count() + 1, 4, '0', STR_PAD_LEFT);

        $donation = Donation::create([
            'receipt_number' => $receiptNumber,
            'donor_name' => $validated['donor_name'],
            'pan_number' => $validated['pan_number'] ?? null,
            'email' => $validated['email'],
            'mobile_number' => $validated['mobile_number'],
            'seva_cause' => $validated['seva_cause'],
            'amount' => $validated['amount'],
            'payment_mode' => $validated['payment_mode'] ?? 'UPI / Online',
            'payment_status' => 'verified',
            'notes' => $validated['notes'] ?? null,
        ]);

        return back()->with('donation_success', [
            'receipt' => $donation->receipt_number,
            'name' => $donation->donor_name,
            'amount' => $donation->amount,
            'cause' => $donation->seva_cause,
        ]);
    }

    /**
     * Events Page
     */
    public function events()
    {
        $events = TempleEvent::orderBy('created_at', 'desc')->get();
        return view('events', compact('events'));
    }

    /**
     * Facilities Page
     */
    public function facilities()
    {
        $facilities = Facility::all();
        return view('facilities', compact('facilities'));
    }

    /**
     * Gallery Page
     */
    public function gallery()
    {
        $galleries = Gallery::where('is_published', true)->latest()->get();
        $categories = Gallery::where('is_published', true)->pluck('category')->unique();
        return view('gallery', compact('galleries', 'categories'));
    }
}
