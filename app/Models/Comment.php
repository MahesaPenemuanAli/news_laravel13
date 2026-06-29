<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'body',
        'is_approved',
    ];

    protected $casts = ['is_approved' => 'boolean'];

    // Komentar ini milik satu Artikel
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Komentar ini ditulis oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jika ini adalah balasan, ia milik satu Komentar Induk (Parent)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Komentar ini memiliki banyak balasan (Children/Replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->oldest();
    }

    public function approvedReplies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->approved()
            ->oldest();
    }

    public function approvedRepliesRecursive()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->approved()
            ->with(['user', 'approvedRepliesRecursive'])
            ->oldest();
    }

    // Scope: Hanya ambil yang sudah di-approve
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // Scope: Hanya ambil komentar utama (bukan balasan)
    public function scopeParentOnly($query)
    {
        return $query->whereNull('parent_id');
    }
}
