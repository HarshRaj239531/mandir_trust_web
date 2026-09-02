<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'mother_name',
        'gender',
        'dob',
        'email',
        'mobile_number',
        'whatsapp_number',
        'pincode',
        'profile_photo',
        'password',
        'is_admin',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dob' => 'date',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the URL for the devotee profile photo / selfie.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            $val = $this->profile_photo;
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
        }

        // Return a default divine avatar based on gender/initials
        return "https://ui-avatars.com/api/?name=" . urlencode($this->nickname ?: $this->name) . "&background=912003&color=FFFDF9&bold=true&size=256";
    }
}
