<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pooja extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'deity',
        'category',
        'dakshina',
        'duration',
        'timing',
        'priest',
        'description',
        'inclusions',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'dakshina' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($pooja) {
            if (empty($pooja->slug)) {
                $pooja->slug = Str::slug($pooja->title) . '-' . rand(100, 999);
            }
        });
    }

    public function bookings()
    {
        return $this->hasMany(PoojaBooking::class);
    }

    /**
     * Get bulletproof public URL for the Pooja image.
     */
    public function getImageUrl(): string
    {
        $val = $this->image;
        if (empty($val)) {
            return asset('images/mandir-aarti.jpg');
        }

        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) {
            return $val;
        }

        $cleanPath = ltrim($val, '/');
        $cleanPath = preg_replace('#^(public/|storage/)#', '', $cleanPath);

        // 1. Check in public/uploads/
        if (file_exists(public_path('uploads/' . $cleanPath))) {
            return asset('uploads/' . $cleanPath);
        }

        // 2. Check in public/storage/
        if (file_exists(public_path('storage/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        // 3. Check in public/
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        // 4. storage/app/public/ check with auto-sync
        $storagePath = storage_path('app/public/' . $cleanPath);
        if (file_exists($storagePath)) {
            try {
                $targetDir = public_path('uploads/' . dirname($cleanPath));
                if (!file_exists($targetDir)) {
                    @mkdir($targetDir, 0755, true);
                }
                @copy($storagePath, public_path('uploads/' . $cleanPath));
                if (file_exists(public_path('uploads/' . $cleanPath))) {
                    return asset('uploads/' . $cleanPath);
                }
            } catch (\Throwable $e) {}

            return route('media.file', ['path' => $cleanPath]);
        }

        return asset('images/mandir-aarti.jpg');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->getImageUrl();
    }
}
