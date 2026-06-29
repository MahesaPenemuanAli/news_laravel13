<?php

namespace App\View\Components;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Navbar extends Component
{
    public array $primaryItems = [];

    public array $moreItems = [];

    public Collection $featuredCategories;

    public Collection $trendingArticles;

    public function __construct()
    {
        $navigationData = Cache::remember('navbar_navigation_data', now()->addHours(24), function () {
            $menu = Menu::query()
                ->where('location', 'header')
                ->with([
                    'items' => fn ($query) => $query
                        ->where('is_active', true)
                        ->with([
                            'category',
                            'page',
                            'children' => fn ($children) => $children
                                ->where('is_active', true)
                                ->with(['category', 'page'])
                                ->orderBy('order'),
                        ])
                        ->orderBy('order'),
                ])
                ->first();

            if ($menu && $menu->items->isNotEmpty()) {
                $items = $menu->items
                    ->map(
                        fn (MenuItem $item): array => $this->menuItemToNavigation(
                            $item,
                        ),
                    )
                    ->values();
            } else {
                $categories = Category::query()
                    ->where('is_active', true)
                    ->whereNull('parent_id')
                    ->with([
                        'children' => fn ($query) => $query
                            ->where('is_active', true)
                            ->orderBy('order'),
                    ])
                    ->orderBy('order')
                    ->get();

                $items = $categories
                    ->map(
                        fn (Category $category): array => $this->categoryToNavigation(
                            $category,
                        ),
                    )
                    ->values();
            }

            return [
                'primary' => $items->take(7)->values()->all(),
                'more' => $items->skip(7)->values()->all(),
            ];
        });

        $this->primaryItems = $navigationData['primary'];
        $this->moreItems = $navigationData['more'];

        $this->featuredCategories = Category::query()
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('order')
            ->take(12)
            ->get();

        $trendingIds = Cache::remember('navbar_trending_ids', now()->addMinutes(10), function () {
            return Article::query()
                ->published()
                ->popular()
                ->take(4)
                ->pluck('id')
                ->toArray();
        });

        $this->trendingArticles = collect();
        if (!empty($trendingIds)) {
            $this->trendingArticles = Article::query()
                ->published()
                ->with('category')
                ->whereIn('id', $trendingIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $trendingIds) . ')')
                ->get();
        }
    }

    private function menuItemToNavigation(MenuItem $item): array
    {
        return [
            'title' => $item->title,
            'url' => $this->resolveMenuItemUrl($item),
            'children' => $item->children
                ->map(
                    fn (MenuItem $child): array => $this->menuItemToNavigation(
                        $child,
                    ),
                )
                ->values()
                ->all(),
        ];
    }

    private function categoryToNavigation(Category $category): array
    {
        return [
            'title' => $category->name,
            'url' => route('category.show', $category->slug),
            'children' => $category->children
                ->map(
                    fn (Category $child): array => $this->categoryToNavigation(
                        $child,
                    ),
                )
                ->values()
                ->all(),
        ];
    }

    private function resolveMenuItemUrl(MenuItem $item): string
    {
        if ($item->url) {
            return str_starts_with($item->url, 'http://') ||
                str_starts_with($item->url, 'https://')
                ? $item->url
                : url($item->url);
        }

        if ($item->category) {
            return route('category.show', $item->category->slug);
        }

        if ($item->page) {
            return url('/page/'.$item->page->slug);
        }

        return '#';
    }

    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
