<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\SacredSeva;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PavitraDaanController extends Controller
{
    /**
     * Display Pavitra Daan Configuration & Management Dashboard.
     */
    public function index()
    {
        $sevas = SacredSeva::ordered()->get();
        $settings = SiteSetting::where('group', 'pavitra_daan')->get()->keyBy('key');
        
        $totalDonations = Donation::sum('amount');
        $totalDonorsCount = Donation::count();

        // Parse preset amounts array for preview
        $presetAmountsRaw = $settings['daan_preset_amounts']->value ?? '501, 1100, 2100, 5100';
        $presetAmounts = array_filter(array_map('trim', explode(',', $presetAmountsRaw)));

        return view('admin.pavitra-daan.index', compact(
            'sevas',
            'settings',
            'totalDonations',
            'totalDonorsCount',
            'presetAmounts'
        ));
    }

    /**
     * Store a newly created Sacred Seva cause.
     */
    public function storeSeva(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'tagline' => ['required', 'string', 'max:255'],
            'impact_description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
            'is_default' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $isDefault = $request->boolean('is_default');
        if ($isDefault) {
            SacredSeva::where('is_default', true)->update(['is_default' => false]);
        }

        SacredSeva::create([
            'title' => $validated['title'],
            'tagline' => $validated['tagline'],
            'impact_description' => $validated['impact_description'],
            'icon' => $validated['icon'] ?: '🕉️',
            'sort_order' => $validated['sort_order'] ?? (SacredSeva::max('sort_order') + 1),
            'is_default' => $isDefault,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', "॥ शुभम् ॥ New Sacred Seva '{$validated['title']}' added and published to Pavitra Daan offering.");
    }

    /**
     * Update an existing Sacred Seva cause.
     */
    public function updateSeva(Request $request, $id)
    {
        $seva = SacredSeva::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'tagline' => ['required', 'string', 'max:255'],
            'impact_description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer'],
            'is_default' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $isDefault = $request->boolean('is_default');
        if ($isDefault && !$seva->is_default) {
            SacredSeva::where('is_default', true)->update(['is_default' => false]);
        }

        $seva->update([
            'title' => $validated['title'],
            'tagline' => $validated['tagline'],
            'impact_description' => $validated['impact_description'],
            'icon' => $validated['icon'] ?: $seva->icon,
            'sort_order' => $validated['sort_order'] ?? $seva->sort_order,
            'is_default' => $isDefault,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', "Sacred Seva '{$seva->title}' details and impact updated successfully.");
    }

    /**
     * Toggle active status of a Sacred Seva.
     */
    public function toggleSevaStatus($id)
    {
        $seva = SacredSeva::findOrFail($id);
        $seva->is_active = !$seva->is_active;
        $seva->save();

        $statusText = $seva->is_active ? 'Activated (Visible on Public Form)' : 'Deactivated (Hidden from Public Form)';
        return back()->with('success', "Seva '{$seva->title}' is now {$statusText}.");
    }

    /**
     * Delete a Sacred Seva cause.
     */
    public function deleteSeva($id)
    {
        $seva = SacredSeva::findOrFail($id);
        $title = $seva->title;
        $seva->delete();

        return back()->with('success', "Sacred Seva '{$title}' removed from Pavitra Daan.");
    }

    /**
     * Update Daan offering global settings (preset amounts, titles, badges, tax notes).
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'daan_step1_badge' => ['required', 'string', 'max:100'],
            'daan_step1_title' => ['required', 'string', 'max:255'],
            'daan_step2_badge' => ['required', 'string', 'max:100'],
            'daan_step2_title' => ['required', 'string', 'max:255'],
            'daan_preset_amounts' => ['required', 'string', 'max:255'],
            'daan_default_amount' => ['required', 'numeric', 'min:1'],
            'daan_custom_amount_label' => ['required', 'string', 'max:255'],
            'daan_80g_note' => ['required', 'string', 'max:255'],
            'daan_security_note' => ['required', 'string', 'max:255'],
            'daan_button_text' => ['required', 'string', 'max:255'],
            'daan_upi_id' => ['nullable', 'string', 'max:100'],
            'daan_qr_code' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $keys = [
            'daan_step1_badge',
            'daan_step1_title',
            'daan_step2_badge',
            'daan_step2_title',
            'daan_preset_amounts',
            'daan_default_amount',
            'daan_custom_amount_label',
            'daan_80g_note',
            'daan_security_note',
            'daan_button_text',
            'daan_upi_id',
        ];

        foreach ($keys as $key) {
            if (isset($validated[$key])) {
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $validated[$key],
                        'type' => 'text',
                        'group' => 'pavitra_daan',
                        'label' => ucwords(str_replace('_', ' ', $key)),
                    ]
                );
            }
        }

        // Handle optional UPI QR code upload
        if ($request->hasFile('daan_qr_code')) {
            $existing = SiteSetting::where('key', 'daan_qr_code')->first();
            if ($existing && $existing->value) {
                ImageHelper::delete($existing->value);
            }
            $qrPath = ImageHelper::processAndStore($request->file('daan_qr_code'), 'settings');
            SiteSetting::updateOrCreate(
                ['key' => 'daan_qr_code'],
                [
                    'value' => $qrPath,
                    'type' => 'image',
                    'group' => 'pavitra_daan',
                    'label' => 'Mandir Trust UPI QR Code',
                ]
            );
        }

        return back()->with('success', 'Pavitra Daan offering settings, amounts, and step headers updated successfully.');
    }
}
