<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable, SoftDeletes;

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'status',
        'published_at',
        'is_breaking_news',
        'is_featured',
        'is_premium',
        'views_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_breaking_news' => 'boolean',
        'is_featured' => 'boolean',
        'is_premium' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'article_tag',
        )->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)
            ->where('is_approved', true)
            ->whereNull('parent_id');
    }

    public function updates()
    {
        return $this->hasMany(ArticleUpdate::class)->latest();
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(
            User::class,
            'article_bookmarks',
        )->withTimestamps();
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeBreaking($query)
    {
        return $query->where('is_breaking_news', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePremium($query)
    {
        return $query->where('is_premium', true);
    }

    public function scopeLatestPublished($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->format('webp');
        $this->addMediaConversion('webp-full')->width(1200)->format('webp');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'status' => $this->status,
            'author_id' => (int) $this->author_id,
            'category_id' => (int) $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt ?? '',
            'content' => strip_tags($this->content ?? ''),
            'category_name' => $this->category ? $this->category->name : '',
            'author_name' => $this->author ? $this->author->name : '',
            'published_at_timestamp' => $this->published_at?->timestamp,
            'views_count' => (int) $this->views_count,
        ];
    }

    public function searchableAs(): string
    {
        return 'articles';
    }

    public function shouldBeSearchable(): bool
    {
        return $this->status === 'published' &&
            $this->published_at !== null &&
            $this->published_at->isPast();
    }

    protected static function booted()
    {
        static::saved(function ($article) {
            // Invalidate caches
            \Illuminate\Support\Facades\Cache::forget('navbar_trending_articles');
            \Illuminate\Support\Facades\Cache::forget('home_trending_articles');
            \Illuminate\Support\Facades\Cache::forget('home_featured_categories');
            \Illuminate\Support\Facades\Cache::forget("category_{$article->category_id}_popular_articles");

            // Generate sitemap
            try {
                \App\Services\SitemapGenerator::generate();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to generate sitemap: ' . $e->getMessage());
            }
        });

        static::deleted(function ($article) {
            // Invalidate caches
            \Illuminate\Support\Facades\Cache::forget('navbar_trending_articles');
            \Illuminate\Support\Facades\Cache::forget('home_trending_articles');
            \Illuminate\Support\Facades\Cache::forget('home_featured_categories');
            \Illuminate\Support\Facades\Cache::forget("category_{$article->category_id}_popular_articles");

            // Generate sitemap
            try {
                \App\Services\SitemapGenerator::generate();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to generate sitemap: ' . $e->getMessage());
            }
        });
    }
}
