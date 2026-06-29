<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Illuminate\Support\Str;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';

    public string $variant = 'light';

    public string $buttonLabel = 'Langganan';

    public function mount(string $variant = 'light', string $buttonLabel = 'Langganan'): void
    {
        $this->variant = $variant;
        $this->buttonLabel = $buttonLabel;
    }

    public function subscribe(): void
    {
        $validated = $this->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
        ]);

        $email = Str::lower($validated['email']);
        $subscriber = Subscriber::firstOrNew(['email' => $email]);

        if (! $subscriber->exists || $subscriber->unsubscribed_at !== null) {
            $subscriber->fill([
                'token' => $subscriber->token ?: Str::random(48),
                'is_verified' => $subscriber->is_verified ?? false,
                'unsubscribed_at' => null,
            ]);
            $subscriber->save();
        }

        $this->reset('email');
        $this->dispatch('toast', type: 'success', message: 'Terima kasih, email Anda sudah terdaftar.');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
