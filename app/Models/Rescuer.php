<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rescuer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'shelter_name',
        'shelter_address',
        'description',
        'is_verified',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the rescuer profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rescue cases for the rescuer.
     */
    public function rescueCases()
    {
        return $this->hasMany(RescueCase::class);
    }
}
