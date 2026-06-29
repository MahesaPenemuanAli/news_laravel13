<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\ArticleView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class TrackArticleView implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $articleId;
    protected $ipAddress;
    protected $userAgent;

    /**
     * Create a new job instance.
     */
    public function __construct($articleId, $ipAddress, $userAgent)
    {
        $this->articleId = $articleId;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $cacheKey = "viewed_article_{$this->articleId}_{$this->ipAddress}";

        // Prevent spam views from the same IP within 1 hour
        if (!Cache::has($cacheKey)) {
            // Set cache for 1 hour
            Cache::put($cacheKey, true, now()->addHour());

            // Increment views count in database
            $article = Article::find($this->articleId);
            if ($article) {
                $article->increment('views_count');

                // Save detailed view
                ArticleView::create([
                    'article_id' => $this->articleId,
                    'ip_address' => $this->ipAddress,
                    'user_agent' => $this->userAgent,
                    'viewed_date' => now()->toDateString(),
                ]);
            }
        }
    }
}
