<?php

namespace App\Services;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Article;
use App\Models\Category;

class SitemapGenerator
{
    public static function generate()
    {
        $sitemap = Sitemap::create();

        // 1. Home Page
        $sitemap->add(
            Url::create(route('home'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
                ->setPriority(1.0)
        );

        // 2. Categories
        $categories = Category::where('is_active', true)->get();
        foreach ($categories as $category) {
            $sitemap->add(
                Url::create(route('category.show', $category->slug))
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8)
            );
        }

        // 3. Articles
        $articles = Article::published()->latestPublished()->get();
        foreach ($articles as $article) {
            $sitemap->add(
                Url::create(route('article.show', $article->slug))
                    ->setLastModificationDate($article->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.6)
            );
        }

        // Save sitemap to public folder
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
