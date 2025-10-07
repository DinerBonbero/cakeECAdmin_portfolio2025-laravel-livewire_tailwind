<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('パスワードの再発行')" :description="__('パスワードリセット用のリンクを受信するため、メールアドレスを送信してください')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('メールアドレス')"
            type="email"
            required
            autofocus
            placeholder="email@example.com"
            viewable
        />

        <flux:button variant="primary" type="submit" class="w-full auth-btn-color">{{ __('パスワードリセットメールを送信') }}</flux:button>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        {{ __('もしくは') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('ログイン') }}</flux:link>
    </div>
</div>
