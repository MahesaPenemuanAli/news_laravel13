<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'is_active', 'expires_at'];
    protected $casts = ['is_active' => 'boolean', 'expires_at' => 'datetime'];

    public function options() { return $this->hasMany(PollOption::class); }
    
    public function scopeActive($query) {
        return $query->where('is_active', true)
                     ->where(function($q) {
                         $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
                     });
    }
}
