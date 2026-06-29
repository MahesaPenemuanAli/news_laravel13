<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Poll;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'parent',
                'children' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('order'),
            ])
            ->firstOrFail();

        $baseQuery = $category
            ->articles()
            ->published()
            ->with(['author', 'category', 'media'])
            ->latestPublished();

        $heroArticles = (clone $baseQuery)->take(4)->get();

        $articles = (clone $baseQuery)
            ->when(
                $heroArticles->isNotEmpty(),
                fn ($query) => $query->whereNotIn(
                    'id',
                    $heroArticles->pluck('id'),
                ),
            )
            ->paginate(9)
            ->withQueryString();

        $popularIds = Cache::remember("category_{$category->id}_popular_ids", now()->addMinutes(10), function () use ($category) {
            $ids = Article::query()
                ->published()
                ->where('category_id', $category->id)
                ->popular()
                ->take(5)
                ->pluck('id')
                ->toArray();

            if (empty($ids)) {
                $ids = Article::query()
                    ->published()
                    ->where('category_id', $category->id)
                    ->latestPublished()
                    ->take(5)
                    ->pluck('id')
                    ->toArray();
            }

            return $ids;
        });

        $popularArticles = collect();
        if (!empty($popularIds)) {
            $popularArticles = Article::query()
                ->published()
                ->with(['category', 'author', 'media'])
                ->whereIn('id', $popularIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $popularIds) . ')')
                ->get();
        }

        $siblingCategories = Category::query()
            ->where('is_active', true)
            ->where('id', '!=', $category->id)
            ->when(
                $category->parent_id,
                fn ($query) => $query->where('parent_id', $category->parent_id),
                fn ($query) => $query->whereNull('parent_id'),
            )
            ->orderBy('order')
            ->take(8)
            ->get();

        $activePoll = Poll::active()->with('options')->latest()->first();

        return view(
            'category',
            compact(
                'category',
                'heroArticles',
                'articles',
                'popularArticles',
                'siblingCategories',
                'activePoll',
            ),
        );
    }
}
