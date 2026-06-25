<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id', 'parent_id', 'title', 'url', 
        'category_id', 'page_id', 'order', 'is_active'
    ];

    public function menu() { return $this->belongsTo(Menu::class); }
    public function parent() { return $this->belongsTo(MenuItem::class, 'parent_id'); }
    public function children() { return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order'); }
    public function category() { return $this->belongsTo(Category::class); }
    public function page() { return $this->belongsTo(Page::class); }
}
