<?php

use App\Livewire\ArticleComments;
use App\Livewire\BookmarkButton;
use App\Livewire\NavbarSearch;
use App\Livewire\NewsletterForm;
use App\Livewire\PollWidget;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Livewire;

function createPublishedArticleForInteractiveFeature(
    string $title = "Berita Interaktif Real Time",
): Article {
    $author = User::factory()->create();
    $categoryName = "Teknologi " . Str::random(6);
    $category = Category::create([
        "name" => $categoryName,
        "slug" => Str::slug($categoryName),
        "description" => "Kategori teknologi.",
        "is_active" => true,
    ]);

    return Article::withoutSyncingToSearch(function () use (
        $author,
        $category,
        $title,
    ) {
        return Article::create([
            "author_id" => $author->id,
            "category_id" => $category->id,
            "title" => $title,
            "slug" => Str::slug($title) . "-" . Str::random(8),
            "excerpt" => "Ringkasan berita interaktif.",
            "content" =>
                "<p>Konten berita untuk pengujian fitur interaktif.</p>",
            "status" => "published",
            "published_at" => now()->subMinute(),
            "is_breaking_news" => false,
            "is_featured" => false,
            "is_premium" => false,
            "views_count" => 0,
        ]);
    });
}

it("shows published articles in instant search results", function () {
    config(["scout.driver" => "database"]);

    $article = createPublishedArticleForInteractiveFeature(
        "Meilisearch Livewire Portal News",
    );

    Livewire::test(NavbarSearch::class)
        ->set("search", "Meilisearch")
        ->assertSee($article->title);
});

it("stores nested comment replies without page reload", function () {
    $article = createPublishedArticleForInteractiveFeature();
    $user = User::factory()->create();
    $parent = Comment::create([
        "article_id" => $article->id,
        "user_id" => $user->id,
        "body" => "Komentar utama",
        "is_approved" => true,
    ]);

    Livewire::actingAs($user)
        ->test(ArticleComments::class, ["article" => $article])
        ->set("replyBodies.{$parent->id}", "Balasan tingkat pertama")
        ->call("postReply", $parent->id)
        ->assertDispatched("toast");

    $reply = Comment::query()
        ->where("parent_id", $parent->id)
        ->where("body", "Balasan tingkat pertama")
        ->firstOrFail();

    Livewire::actingAs($user)
        ->test(ArticleComments::class, ["article" => $article])
        ->set("replyBodies.{$reply->id}", "Balasan bersarang")
        ->call("postReply", $reply->id)
        ->assertDispatched("toast");

    $this->assertDatabaseHas("comments", [
        "article_id" => $article->id,
        "parent_id" => $reply->id,
        "body" => "Balasan bersarang",
        "is_approved" => true,
    ]);
});

it("records a poll vote and renders the result state", function () {
    $poll = Poll::create([
        "question" => "Apakah fitur real-time membantu?",
        "is_active" => true,
    ]);
    $yes = PollOption::create([
        "poll_id" => $poll->id,
        "option_text" => "Ya",
        "votes_count" => 0,
    ]);
    PollOption::create([
        "poll_id" => $poll->id,
        "option_text" => "Tidak",
        "votes_count" => 0,
    ]);

    Livewire::test(PollWidget::class, ["poll" => $poll])
        ->set("selectedOptionId", $yes->id)
        ->call("vote")
        ->assertDispatched("toast")
        ->assertSee("100%");

    expect($yes->fresh()->votes_count)->toBe(1);
    $this->assertDatabaseHas("poll_votes", [
        "poll_option_id" => $yes->id,
    ]);
});

it("subscribes an email through the newsletter form", function () {
    Livewire::test(NewsletterForm::class)
        ->set("email", "PEMBACA@Example.COM")
        ->call("subscribe")
        ->assertDispatched("toast");

    $this->assertDatabaseHas("subscribers", [
        "email" => "pembaca@example.com",
        "is_verified" => false,
    ]);
});

it("toggles article bookmarks for authenticated users", function () {
    $article = createPublishedArticleForInteractiveFeature();
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(BookmarkButton::class, ["article" => $article])
        ->call("toggle")
        ->assertSet("bookmarked", true)
        ->assertDispatched("toast");

    $this->assertDatabaseHas("article_bookmarks", [
        "user_id" => $user->id,
        "article_id" => $article->id,
    ]);
});
