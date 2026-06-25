<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- RELASI USER ---
    
    // Seorang user bisa menjadi penulis banyak artikel
    public function articles() {
        return $this->hasMany(Article::class, 'author_id');
    }

    // Seorang user memiliki satu profil penulis (Author Profile)
    public function profile() {
        return $this->hasOne(AuthorProfile::class);
    }

    // Seorang user bisa membuat banyak komentar
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Seorang user bisa melakukan voting di banyak polling
    public function pollVotes() {
        return $this->hasMany(PollVote::class);
    }

    // Seorang user bisa mem-bookmark banyak artikel (Many-to-Many)
    public function bookmarkedArticles() {
        return $this->belongsToMany(Article::class, 'article_bookmarks')
                    ->withTimestamps();
    }
}
