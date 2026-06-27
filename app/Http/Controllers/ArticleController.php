<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleView;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['author', 'category', 'tags'])
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
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('article', compact('article', 'relatedArticles'));
    }
}
