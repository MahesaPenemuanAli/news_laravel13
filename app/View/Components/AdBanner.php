<?php

namespace App\View\Components;

use App\Models\Ad;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdBanner extends Component
{
    public $position;
    public $ad;

    public function __construct($position = 'header')
    {
        $this->position = $position;
        // Fetch active ad for this position
        $this->ad = Ad::active()
            ->position($position)
            ->inRandomOrder()
            ->first();
            
        // Increment impression if ad is displayed
        if ($this->ad) {
            $this->ad->increment('impressions');
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.ad-banner');
    }
}
