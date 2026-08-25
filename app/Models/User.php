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
            if (str_starts_with($this->profile_photo, 'http://') || str_starts_with($this->profile_photo, 'https://')) {
                return $this->profile_photo;
            }
            return asset('storage/' . $this->profile_photo);
        }

        // Return a default divine avatar based on gender/initials
        $initial = strtoupper(substr($this->nickname ?: $this->name, 0, 1));
        return "https://ui-avatars.com/api/?name=" . urlencode($this->nickname ?: $this->name) . "&background=912003&color=FFFDF9&bold=true&size=256";
    }
}
