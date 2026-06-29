<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleView;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->with(['author.profile', 'category', 'tags', 'media'])
            ->firstOrFail();

        // Increment views
        $article->increment('views_count');

        // Save detailed view
        ArticleView::create([
            'article_id' => $article->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'viewed_date' => now()->toDateString(),
        ]);

        $relatedArticles = Article::published()
            ->with(['category', 'author', 'media'])
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('article', compact('article', 'relatedArticles'));
    }
}
