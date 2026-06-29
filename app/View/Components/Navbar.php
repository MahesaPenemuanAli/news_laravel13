<?php

namespace App\View\Components;

use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Navbar extends Component
{
    public ?Menu $menu = null;

    public Collection $categories;

    public array $primaryItems = [];

    public array $moreItems = [];

    public Collection $featuredCategories;

    public Collection $trendingArticles;

    public function __construct()
    {
        $this->menu = Menu::query()
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

        $this->categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with([
                'children' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('order'),
            ])
            ->orderBy('order')
            ->get();

        $navigationItems = $this->resolveNavigationItems();

        $this->primaryItems = $navigationItems->take(7)->values()->all();
        $this->moreItems = $navigationItems->skip(7)->values()->all();

        $this->featuredCategories = Category::query()
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('order')
            ->take(12)
            ->get();

        $this->trendingArticles = Article::query()
            ->published()
            ->with('category')
            ->popular()
            ->take(4)
            ->get();
    }

    private function resolveNavigationItems(): Collection
    {
        if ($this->menu && $this->menu->items->isNotEmpty()) {
            return $this->menu->items
                ->map(
                    fn (MenuItem $item): array => $this->menuItemToNavigation(
                        $item,
                    ),
                )
                ->values();
        }

        return $this->categories
            ->map(
                fn (Category $category): array => $this->categoryToNavigation(
                    $category,
                ),
            )
            ->values();
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
