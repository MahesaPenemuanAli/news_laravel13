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
        'icon_class', 'order', 'is_active'
    ];

    protected $casts = ['is_active' => 'boolean'];

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
}
