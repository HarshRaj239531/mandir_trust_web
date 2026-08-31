<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TempleEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'event_date',
        'timings',
        'expected_crowd',
        'coordinator',
        'description',
        'image',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . rand(100, 999);
            }
        });
    }
}
