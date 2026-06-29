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

        // Track view asynchronously with spam protection
        \App\Jobs\TrackArticleView::dispatch(
            $article->id,
            request()->ip(),
            request()->userAgent()
        );

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
