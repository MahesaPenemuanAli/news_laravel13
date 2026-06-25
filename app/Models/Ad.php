<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image_url', 'target_url', 'position', 
        'start_date', 'end_date', 'is_active', 'impressions', 'clicks'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Scope untuk mengambil iklan yang sedang tayang hari ini
    public function scopeActive($query) {
        return $query->where('is_active', true)
                     ->where('start_date', '<=', now()->toDateString())
                     ->where('end_date', '>=', now()->toDateString());
    }

    public function scopePosition($query, $position) {
        return $query->where('position', $position);
    }
}
