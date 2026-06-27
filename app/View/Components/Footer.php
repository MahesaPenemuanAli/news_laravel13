<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public $menu;
    public $categories;

    public function __construct()
    {
        $this->menu = Menu::where('location', 'footer')->with('items.children', 'items.category')->first();

        // Fallback: jika tidak ada Footer Menu, ambil kategori aktif
        if (!$this->menu || $this->menu->items->isEmpty()) {
            $this->categories = Category::where('is_active', true)->orderBy('order')->get();
        } else {
            $this->categories = collect();
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
