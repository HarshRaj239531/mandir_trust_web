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
}
