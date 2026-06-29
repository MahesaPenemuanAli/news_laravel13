<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = Article::published()
            ->with(['category', 'author', 'media'])
            ->breaking()
            ->latestPublished()
            ->take(5)
            ->get();

        $featuredArticles = Article::published()
            ->with(['category', 'author', 'media'])
            ->featured()
            ->latestPublished()
            ->take(3)
            ->get();

        if ($featuredArticles->count() < 3) {
            $needed = 3 - $featuredArticles->count();
            $moreArticles = Article::published()
                ->with(['category', 'author', 'media'])
                ->latestPublished()
                ->whereNotIn('id', $featuredArticles->pluck('id'))
                ->take($needed)
                ->get();
            $featuredArticles = $featuredArticles->concat($moreArticles);
        }

        $latestArticles = Article::published()
            ->with(['category', 'author', 'media'])
            ->latestPublished()
            ->whereNotIn('id', $featuredArticles->pluck('id'))
            ->take(6)
            ->get();

        $featuredCategories = Category::where('is_featured', true)
            ->where('is_active', true)
            ->with([
                'articles' => function ($query) {
                    $query
                        ->published()
                        ->with(['category', 'author', 'media'])
                        ->latestPublished()
                        ->take(4);
                },
            ])
            ->orderBy('order')
            ->get();

        // Trending: artikel paling banyak dibaca
        $trendingArticles = Article::published()
            ->with(['category', 'author', 'media'])
            ->where('views_count', '>', 0)
            ->popular()
            ->take(5)
            ->get();

        // Jika belum ada views, fallback ke artikel terbaru
        if ($trendingArticles->isEmpty()) {
            $trendingArticles = Article::published()
                ->with(['category', 'author', 'media'])
                ->latestPublished()
                ->whereNotIn('id', $featuredArticles->pluck('id'))
                ->whereNotIn('id', $latestArticles->pluck('id'))
                ->take(5)
                ->get();
        }

        // Tag populer (berdasarkan jumlah artikel terbanyak)
        $popularTags = Tag::withCount('articles')
            ->orderByDesc('articles_count')
            ->take(15)
            ->get();

        // Polling aktif
        $activePoll = Poll::active()->with('options')->latest()->first();

        return view(
            'welcome',
            compact(
                'breakingNews',
                'featuredArticles',
                'latestArticles',
                'featuredCategories',
                'trendingArticles',
                'popularTags',
                'activePoll',
            ),
        );
    }
}
