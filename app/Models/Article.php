<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'author_id', 'category_id', 'title', 'slug', 'excerpt', 'content',
        'status', 'published_at', 'is_breaking_news', 'is_featured', 'is_premium',
        'views_count', 'meta_title', 'meta_description'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_breaking_news' => 'boolean',
        'is_featured' => 'boolean',
        'is_premium' => 'boolean',
    ];

    // --- RELASI ---
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function category() { return $this->belongsTo(Category::class); }
    public function tags() { return $this->belongsToMany(Tag::class, 'article_tag'); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function updates() { return $this->hasMany(ArticleUpdate::class)->latest(); }
    public function views() { return $this->hasMany(ArticleView::class); }

    // --- SCOPES (Filter Query Bawaan) ---
    public function scopePublished($query) {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeBreaking($query) {
        return $query->where('is_breaking_news', true);
    }

    public function scopeFeatured($query) {
        return $query->where('is_featured', true);
    }

    // --- SPATIE MEDIALIBRARY (Konversi Gambar Otomatis) ---
    public function registerMediaConversions(Media $media = null): void
    {
        // Thumbnail kecil untuk card berita (Format WebP agar ringan)
        $this->addMediaConversion('thumb')
              ->width(400)
              ->height(300)
              ->format('webp');

        // Gambar ukuran penuh untuk di dalam artikel
        $this->addMediaConversion('webp-full')
              ->width(1200)
              ->format('webp');
    }
}
