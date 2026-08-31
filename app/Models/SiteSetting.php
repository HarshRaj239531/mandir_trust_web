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

        if (Storage::disk('public')->exists($val)) {
            return asset('storage/' . $val);
        }

        return asset($val);
    }
}

