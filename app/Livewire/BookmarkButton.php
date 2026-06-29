<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookmarkButton extends Component
{
    public Article $article;

    public bool $bookmarked = false;

    public function mount(): void
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return;
        }

        $this->bookmarked = $user
            ->bookmarkedArticles()
            ->whereKey($this->article->id)
            ->exists();
    }

    public function toggle(): void
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return;
        }

        $exists = $user
            ->bookmarkedArticles()
            ->whereKey($this->article->id)
            ->exists();

        if ($exists) {
            $user->bookmarkedArticles()->detach($this->article->id);
            $this->bookmarked = false;
            $this->dispatch(
                'toast',
                type: 'info',
                message: 'Artikel dihapus dari bookmark.',
            );

            return;
        }

        $user->bookmarkedArticles()->attach($this->article->id);
        $this->bookmarked = true;
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Artikel disimpan ke bookmark.',
        );
    }

    public function render()
    {
        return view('livewire.bookmark-button');
    }
}
