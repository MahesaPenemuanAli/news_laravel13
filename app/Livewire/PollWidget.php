<?php

namespace App\Livewire;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PollWidget extends Component
{
    public ?int $pollId = null;

    public ?int $selectedOptionId = null;

    public function mount(?Poll $poll = null): void
    {
        $this->pollId = $poll?->id ?? Poll::active()->latest()->value('id');
    }

    public function vote(): void
    {
        $poll = $this->poll();

        if (! $poll) {
            return;
        }

        $this->validate(
            [
                'selectedOptionId' => ['required', 'integer'],
            ],
            [
                'selectedOptionId.required' => 'Pilih salah satu jawaban terlebih dahulu.',
            ],
        );

        $option = PollOption::query()
            ->where('poll_id', $poll->id)
            ->whereKey($this->selectedOptionId)
            ->firstOrFail();

        if ($this->hasVoted($poll)) {
            $this->dispatch(
                'toast',
                type: 'info',
                message: 'Anda sudah memberikan suara.',
            );

            return;
        }

        DB::transaction(function () use ($poll, $option) {
            if ($this->hasVoted($poll)) {
                return;
            }

            PollVote::create([
                'poll_option_id' => $option->id,
                'user_id' => Auth::id(),
                'ip_address' => request()->ip(),
            ]);

            $option->increment('votes_count');
        });

        $this->selectedOptionId = null;
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Terima kasih, suara Anda sudah direkam.',
        );
    }

    public function render()
    {
        $poll = $this->poll();

        return view('livewire.poll-widget', [
            'poll' => $poll,
            'hasVoted' => $poll ? $this->hasVoted($poll) : false,
            'totalVotes' => $poll
                ? (int) $poll->options->sum('votes_count')
                : 0,
        ]);
    }

    private function poll(): ?Poll
    {
        if (! $this->pollId) {
            return null;
        }

        return Poll::active()->with('options')->find($this->pollId);
    }

    private function hasVoted(Poll $poll): bool
    {
        return PollVote::query()
            ->whereHas(
                'option',
                fn ($option) => $option->where('poll_id', $poll->id),
            )
            ->when(
                Auth::check(),
                fn ($query) => $query->where('user_id', Auth::id()),
                fn ($query) => $query
                    ->whereNull('user_id')
                    ->where('ip_address', request()->ip()),
            )
            ->exists();
    }
}
