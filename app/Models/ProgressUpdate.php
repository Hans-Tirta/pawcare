<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressUpdate extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rescue_case_id',
        'title',
        'description',
        'expense_amount',
        'photo',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expense_amount' => 'decimal:2',
        ];
    }

    /**
     * Get the rescue case that owns the progress update.
     */
    public function rescueCase()
    {
        return $this->belongsTo(RescueCase::class);
    }
}
