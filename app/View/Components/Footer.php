<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public $menu;

    public function __construct()
    {
        $this->menu = Menu::where('location', 'footer')->with('items.children')->first();
    }

    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
