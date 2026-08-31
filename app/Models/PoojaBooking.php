<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoojaBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'pooja_id',
        'pooja_name',
        'devotee_name',
        'gotra',
        'nakshatra',
        'preferred_date',
        'mobile_number',
        'email',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'preferred_date' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    public function pooja()
    {
        return $this->belongsTo(Pooja::class);
    }
}
