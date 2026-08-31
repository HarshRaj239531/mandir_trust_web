<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'donor_name',
        'pan_number',
        'email',
        'mobile_number',
        'seva_cause',
        'amount',
        'payment_mode',
        'payment_status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }
}
