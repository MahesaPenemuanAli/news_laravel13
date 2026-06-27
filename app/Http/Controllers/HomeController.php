<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Poll;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = Article::published()->breaking()->latestPublished()->take(5)->get();
        
        $featuredArticles = Article::published()->featured()->latestPublished()->take(3)->get();
        
        if ($featuredArticles->count() < 3) {
            $needed = 3 - $featuredArticles->count();
            $moreArticles = Article::published()->latestPublished()
                ->whereNotIn('id', $featuredArticles->pluck('id'))
                ->take($needed)->get();
            $featuredArticles = $featuredArticles->concat($moreArticles);
        }
        
        $latestArticles = Article::published()->latestPublished()
            ->whereNotIn('id', $featuredArticles->pluck('id'))
            ->take(6)->get();

        $featuredCategories = Category::where('is_featured', true)
            ->where('is_active', true)
            ->with(['articles' => function ($query) {
                $query->published()->latestPublished()->take(4);
            }])
            ->orderBy('order')
            ->get();

        // Trending: artikel paling banyak dibaca
        $trendingArticles = Article::published()
            ->where('views_count', '>', 0)
            ->popular()
            ->take(5)
            ->get();

        // Jika belum ada views, fallback ke artikel terbaru
        if ($trendingArticles->isEmpty()) {
            $trendingArticles = Article::published()
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
        $activePoll = Poll::where('is_active', true)
            ->with('options')
            ->latest()
            ->first();

        return view('welcome', compact(
            'breakingNews',
            'featuredArticles',
            'latestArticles',
            'featuredCategories',
            'trendingArticles',
            'popularTags',
            'activePoll'
        ));
    }
}
