<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
    ];

    /**
     * Get a setting value with fallback.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = static::where('key', $key)->first();
        return ($setting && $setting->value) ? $setting->value : $default;
    }

    /**
     * Get image url for an image setting with fallback asset path.
     */
    public static function getImageUrl(string $key, string $defaultAsset): string
    {
        $val = static::get($key);
        if (!$val) {
            return asset($defaultAsset);
        }

        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) {
            return $val;
        }

        // Direct static public file in public/uploads/ or public/images/
        if (str_starts_with($val, 'uploads/') || str_starts_with($val, 'images/')) {
            return asset($val);
        }

        // Check if file exists directly in public folder
        if (file_exists(public_path($val)) && is_file(public_path($val))) {
            return asset($val);
        }

        // Check if file exists in public/uploads/
        if (file_exists(public_path('uploads/' . $val)) && is_file(public_path('uploads/' . $val))) {
            return asset('uploads/' . $val);
        }

        // Try syncing from storage/app/public/ to public/uploads/
        $storageFile = storage_path('app/public/' . $val);
        if (file_exists($storageFile) && is_file($storageFile)) {
            try {
                $targetDir = public_path('uploads/' . dirname($val));
                if (!file_exists($targetDir)) {
                    @mkdir($targetDir, 0755, true);
                }
                @copy($storageFile, public_path('uploads/' . $val));
                if (file_exists(public_path('uploads/' . $val))) {
                    return asset('uploads/' . $val);
                }
            } catch (\Throwable $e) {
                // Continue to media route
            }

            // Check if public/storage symlink exists and works
            if (file_exists(public_path('storage/' . $val))) {
                return asset('storage/' . $val);
            }

            return route('media.file', ['path' => $val]);
        }

        if (str_starts_with($val, 'storage/')) {
            return asset($val);
        }

        return route('media.file', ['path' => $val]);
    }
}

