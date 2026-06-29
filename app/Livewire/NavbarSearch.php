<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Collection;
use Livewire\Component;
use Throwable;

class NavbarSearch extends Component
{
    public string $search = '';

    public int $limit = 6;

    public function clear(): void
    {
        $this->reset('search');
    }

    public function render()
    {
        $articles = collect();
        $term = trim($this->search);

        if (mb_strlen($term) >= 2) {
            $articles = $this->searchArticles($term);
        }

        return view('livewire.navbar-search', [
            'articles' => $articles,
            'term' => $term,
        ]);
    }

    private function searchArticles(string $term): Collection
    {
        try {
            return Article::search($term)
                ->where('status', 'published')
                ->query(function ($query) {
                    $query
                        ->published()
                        ->with(['category', 'author', 'media'])
                        ->latestPublished();
                })
                ->take($this->limit)
                ->get();
        } catch (Throwable) {
            return Article::query()
                ->published()
                ->with(['category', 'author', 'media'])
                ->where(function ($query) use ($term) {
                    $query
                        ->where('title', 'like', "%{$term}%")
                        ->orWhere('excerpt', 'like', "%{$term}%")
                        ->orWhere('content', 'like', "%{$term}%")
                        ->orWhereHas(
                            'category',
                            fn ($category) => $category->where(
                                'name',
                                'like',
                                "%{$term}%",
                            ),
                        )
                        ->orWhereHas(
                            'author',
                            fn ($author) => $author->where(
                                'name',
                                'like',
                                "%{$term}%",
                            ),
                        );
                })
                ->latestPublished()
                ->take($this->limit)
                ->get();
        }
    }
}
