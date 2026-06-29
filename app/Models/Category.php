<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'parent_id', 'name', 'slug', 'description', 
        'icon_class', 'order', 'is_active', 'is_featured'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Kategori ini adalah anak dari kategori lain (jika parent_id ada)
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Kategori ini memiliki anak-anak (sub-kategori)
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Kategori memiliki banyak artikel
    public function articles() {
        return $this->hasMany(Article::class);
    }

    protected static function booted()
    {
        static::saved(function ($category) {
            // Invalidate caches
            \Illuminate\Support\Facades\Cache::forget('navbar_categories');
            \Illuminate\Support\Facades\Cache::forget('navbar_featured_categories');
            \Illuminate\Support\Facades\Cache::forget('home_featured_categories');
            \Illuminate\Support\Facades\Cache::forget("category_{$category->id}_popular_articles");

            // Generate sitemap
            try {
                \App\Services\SitemapGenerator::generate();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to generate sitemap: ' . $e->getMessage());
            }
        });

        static::deleted(function ($category) {
            // Invalidate caches
            \Illuminate\Support\Facades\Cache::forget('navbar_categories');
            \Illuminate\Support\Facades\Cache::forget('navbar_featured_categories');
            \Illuminate\Support\Facades\Cache::forget('home_featured_categories');
            \Illuminate\Support\Facades\Cache::forget("category_{$category->id}_popular_articles");

            // Generate sitemap
            try {
                \App\Services\SitemapGenerator::generate();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to generate sitemap: ' . $e->getMessage());
            }
        });
    }
}
