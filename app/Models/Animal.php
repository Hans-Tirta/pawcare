<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rescue_case_id',
        'name',
        'species',
        'age',
        'gender',
        'condition',
        'status',
        'photo',
    ];

    /**
     * Get the rescue case that owns the animal.
     */
    public function rescueCase()
    {
        return $this->belongsTo(RescueCase::class);
    }
}
