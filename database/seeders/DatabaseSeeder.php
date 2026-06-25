<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@news.com',
        ]);

        $reporters = User::factory()->count(3)->create();

        $categoryNames = ['Nasional', 'Internasional', 'Bisnis', 'Teknologi', 'Olahraga', 'Hiburan'];
        $categories = collect($categoryNames)->map(function ($name) {
            return Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => "Kumpulan berita {$name} terkini dan terpercaya.",
                'is_active' => true,
            ]);
        });

        $tags = Tag::factory()->count(20)->create();

        $articles = Article::factory()
            ->count(50)
            ->create([
                'author_id' => $reporters->random()->id,
                'category_id' => $categories->random()->id,
            ]);

        $articles->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(2, 4))->pluck('id')->toArray()
            );
        });

        Comment::factory()->count(100)->create([
            'article_id' => $articles->random()->id,
            'user_id' => $reporters->random()->id,
        ]);

        $poll = Poll::create([
            'question' => 'Menurut Anda, apakah TALL Stack adalah masa depan pengembangan web?',
            'is_active' => true,
        ]);
        
        PollOption::create(['poll_id' => $poll->id, 'option_text' => 'Ya, Sangat Setuju', 'votes_count' => 145]);
        PollOption::create(['poll_id' => $poll->id, 'option_text' => 'Biasa Saja', 'votes_count' => 32]);
        PollOption::create(['poll_id' => $poll->id, 'option_text' => 'Tidak, Lebih Suka React', 'votes_count' => 58]);
    }
}
