<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'location'];

    public function items() {
        // Hanya ambil item utama (bukan sub-menu), diurutkan berdasarkan 'order'
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('order');
    }
}
