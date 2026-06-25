<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'user_id', 'parent_id', 'body', 'is_approved'];
    protected $casts = ['is_approved' => 'boolean'];

    public function article() { return $this->belongsTo(Article::class); }
    public function user() { return $this->belongsTo(User::class); }
    
    // Relasi ke induk komentar (jika ini adalah balasan)
    public function parent() { return $this->belongsTo(Comment::class, 'parent_id'); }
    // Relasi ke anak-anak komentar (balasan dari komentar ini)
    public function replies() { return $this->hasMany(Comment::class, 'parent_id'); }
    
    public function scopeApproved($query) { return $query->where('is_approved', true); }
    public function scopeParentOnly($query) { return $query->whereNull('parent_id'); }
}
