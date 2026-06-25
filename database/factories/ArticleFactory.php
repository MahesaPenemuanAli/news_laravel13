<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);
        return [
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(5),
            'excerpt' => fake()->paragraph(),
            'content' => '<p>' . implode('</p><p>', fake()->paragraphs(5)) . '</p>',
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'is_breaking_news' => fake()->boolean(10),
            'is_featured' => fake()->boolean(15),
            'is_premium' => false,
            'views_count' => fake()->numberBetween(100, 15000),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (\App\Models\Article $article) {
            $imageUrl = "https://picsum.photos/800/500?random=" . $article->id;
            try {
                $article->addMediaFromUrl($imageUrl)->toMediaCollection('images');
            } catch (\Exception $e) {
                // Abaikan jika gambar gagal diunduh karena koneksi internet
            }
        });
    }
}
