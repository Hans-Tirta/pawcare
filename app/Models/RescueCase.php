<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RescueCase extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rescuer_id',
        'title',
        'description',
        'location',
        'target_amount',
        'current_amount',
        'status',
        'thumbnail',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
            'current_amount' => 'decimal:2',
        ];
    }

    /**
     * Get the rescuer that owns the rescue case.
     */
    public function rescuer()
    {
        return $this->belongsTo(Rescuer::class);
    }

    /**
     * Get the animals for the rescue case.
     */
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    /**
     * Get the progress updates for the rescue case.
     */
    public function progressUpdates()
    {
        return $this->hasMany(ProgressUpdate::class);
    }

    /**
     * Get the donations for the rescue case.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the total expenses from progress updates.
     */
    public function totalExpenses()
    {
        return $this->progressUpdates()->sum('expense_amount');
    }

    /**
     * Get the donation progress percentage.
     */
    public function progressPercentage(): float
    {
        if ($this->target_amount == 0) {
            return 0;
        }
        return min(($this->current_amount / $this->target_amount) * 100, 100);
    }
}
