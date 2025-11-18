<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rescue_case_id',
        'donor_id',
        'amount',
        'payment_method',
        'payment_status',
        'midtrans_order_id',
        'midtrans_snap_token',
        'message',
        'is_anonymous',
        'paid_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_anonymous' => 'boolean',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * Get the rescue case that owns the donation.
     */
    public function rescueCase()
    {
        return $this->belongsTo(RescueCase::class);
    }

    /**
     * Get the donor (user) that made the donation.
     */
    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    /**
     * Scope a query to only include successful donations.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('payment_status', 'success');
    }

    /**
     * Scope a query to only include pending donations.
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }
}
