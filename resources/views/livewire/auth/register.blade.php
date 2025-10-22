<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('user_info.create', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">

        <flux:input
            wire:model="name"
            :label="__('名前')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('苺野　慶喜')"
        />

        <flux:input
            wire:model="email"
            :label="__('メールアドレス')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <flux:input
            wire:model="password"
            :label="__('パスワード')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('パスワード')"
            viewable
        />

        <flux:input
            wire:model="password_confirmation"
            :label="__('パスワードを再入力')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('パスワードを再入力')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full auth-btn-color">
                {{ __('アカウントを作成') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('アカウントをお持ちの方は') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('ログイン') }}</flux:link>
    </div>
</div>
