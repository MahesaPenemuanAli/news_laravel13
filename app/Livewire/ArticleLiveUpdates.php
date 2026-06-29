<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleLiveUpdates extends Component
{
    public Article $article;

    public function render()
    {
        return view('livewire.article-live-updates', [
            'updates' => $this->article
                ->updates()
                ->latest()
                ->get(),
        ]);
    }
}
