<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'bio', 'expertise', 'photo', 
        'facebook_url', 'twitter_url', 'instagram_url'
    ];

    // Profil ini milik satu User
    public function user() {
        return $this->belongsTo(User::class);
    }
}
