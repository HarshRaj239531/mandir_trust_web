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
        'member_id',
        'sponsor_id',
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

    /**
     * Generate a unique 12-digit Member ID prefixed with capital "DS".
     * Example format: DS123456789012 (DS + 12 digits = 14 chars total).
     */
    public static function generateMemberId(): string
    {
        do {
            // Generate 12 random numeric digits
            $part1 = str_pad((string) mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
            $part2 = str_pad((string) mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
            $code = 'DS' . $part1 . $part2;
        } while (static::where('member_id', $code)->exists());

        return $code;
    }

    /**
     * Sponsor (the upline devotee who introduced this user).
     */
    public function sponsor()
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    /**
     * Direct Referrals (the direct downline devotees sponsored by this user - 3-share model).
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'sponsor_id')->latest();
    }

    /**
     * Get multi-level downline genealogy tree (Level 1, Level 2, Level 3).
     * Level 1: Direct shares (target 3)
     * Level 2: Downline from Level 1 (target 9)
     * Level 3: Downline from Level 2 (target 27)
     */
    public function getGenealogyTree(int $maxLevel = 3): array
    {
        $levels = [];
        $currentLevelUsers = $this->referrals()->with('referrals')->get();
        $levels[1] = $currentLevelUsers;

        if ($maxLevel >= 2) {
            $level2 = collect();
            foreach ($currentLevelUsers as $user) {
                foreach ($user->referrals as $subUser) {
                    $level2->push($subUser);
                }
            }
            $levels[2] = $level2;

            if ($maxLevel >= 3) {
                $level3 = collect();
                foreach ($level2 as $user) {
                    $userReferrals = $user->referrals()->get();
                    foreach ($userReferrals as $subUser) {
                        $level3->push($subUser);
                    }
                }
                $levels[3] = $level3;
            }
        }

        return $levels;
    }

    /**
     * Total count of all downline team members (Level 1 + Level 2 + Level 3).
     */
    public function getTotalTeamCountAttribute(): int
    {
        $tree = $this->getGenealogyTree(3);
        $count = 0;
        foreach ($tree as $levelUsers) {
            $count += $levelUsers->count();
        }
        return $count;
    }
}

