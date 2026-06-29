<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

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

        // Trending: artikel paling banyak dibaca (Cache hanya ID untuk menghindari error serialisasi PHP)
        $trendingIds = Cache::remember('home_trending_ids', now()->addMinutes(10), function () use ($featuredArticles, $latestArticles) {
            $ids = Article::published()
                ->where('views_count', '>', 0)
                ->popular()
                ->take(5)
                ->pluck('id')
                ->toArray();

            // Jika belum ada views, fallback ke artikel terbaru
            if (empty($ids)) {
                $ids = Article::published()
                    ->latestPublished()
                    ->whereNotIn('id', $featuredArticles->pluck('id'))
                    ->whereNotIn('id', $latestArticles->pluck('id'))
                    ->take(5)
                    ->pluck('id')
                    ->toArray();
            }

            return $ids;
        });

        $trendingArticles = collect();
        if (!empty($trendingIds)) {
            $trendingArticles = Article::published()
                ->with(['category', 'author', 'media'])
                ->whereIn('id', $trendingIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $trendingIds) . ')')
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
