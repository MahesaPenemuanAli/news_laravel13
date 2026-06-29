<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ArticleComments extends Component
{
    public Article $article;

    public string $body = '';

    public ?int $replyingTo = null;

    public array $replyBodies = [];

    protected array $messages = [
        'body.required' => 'Isi komentar terlebih dahulu.',
        'body.min' => 'Komentar minimal :min karakter.',
        'body.max' => 'Komentar maksimal :max karakter.',
        'replyBodies.*.required' => 'Isi balasan terlebih dahulu.',
        'replyBodies.*.min' => 'Balasan minimal :min karakter.',
        'replyBodies.*.max' => 'Balasan maksimal :max karakter.',
    ];

    public function postComment(): void
    {
        if (! Auth::check()) {
            $this->dispatch(
                'toast',
                type: 'error',
                message: 'Silakan masuk untuk mengirim komentar.',
            );

            return;
        }

        $this->body = trim($this->body);

        $validated = $this->validate([
            'body' => ['required', 'string', 'min:3', 'max:1000'],
        ]);

        $this->article->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
            'is_approved' => true,
        ]);

        $this->reset('body');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Komentar berhasil dikirim.',
        );
    }

    public function postReply(int $commentId): void
    {
        if (! Auth::check()) {
            $this->dispatch(
                'toast',
                type: 'error',
                message: 'Silakan masuk untuk mengirim balasan.',
            );

            return;
        }

        $comment = Comment::query()
            ->where('article_id', $this->article->id)
            ->approved()
            ->findOrFail($commentId);

        $this->replyBodies[$commentId] = trim(
            (string) ($this->replyBodies[$commentId] ?? ''),
        );

        $this->validate([
            "replyBodies.{$commentId}" => [
                'required',
                'string',
                'min:3',
                'max:1000',
            ],
        ]);

        $comment->replies()->create([
            'article_id' => $this->article->id,
            'user_id' => Auth::id(),
            'body' => $this->replyBodies[$commentId],
            'is_approved' => true,
        ]);

        unset($this->replyBodies[$commentId]);
        $this->replyingTo = null;
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Balasan berhasil dikirim.',
        );
    }

    public function startReply(int $commentId): void
    {
        $this->replyingTo =
            $this->replyingTo === $commentId ? null : $commentId;
    }

    public function cancelReply(): void
    {
        $this->replyingTo = null;
    }

    public function render()
    {
        return view('livewire.article-comments', [
            'comments' => $this->article
                ->approvedComments()
                ->with(['user', 'approvedRepliesRecursive'])
                ->latest()
                ->get(),
            'commentsCount' => $this->article->comments()->approved()->count(),
        ]);
    }
}
