<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {

        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('items.index', absolute: false), navigate: true);

        session()->forget('url.intended');
    }

    protected function ensureIsNotRateLimited(): void
    {

        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {

        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

@php

    //Voltにはビューにコントローラメソッドを直接配置するスタイルかつ、
    //ログイン画面の表示処理のメソッドがないため直前のURLを保存するコードを直書きで記載する。

    if (session()->missing('url.intended')) {
        //セッションに遷移元URLがないとき、

        session(['url.intended' => url()->previous()]); //直前のURLを保存する
    }
@endphp
<div class="flex flex-col gap-6">

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">

        <flux:input wire:model="email" :label="__('メールアドレス')" type="email" required autofocus autocomplete="email"
            placeholder="email@example.com" />

        <div class="relative">
            <flux:input wire:model="password" :label="__('パスワード')" type="password" required
                autocomplete="current-password" :placeholder="__('Password')" viewable />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('パスワードを忘れたとき?') }}
                </flux:link>
            @endif
        </div>

        <flux:checkbox wire:model="remember" :label="__('このブラウザに認証情報を記憶')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full auth-btn-color">{{ __('ログイン') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('アカウントをお持ち得ない方は') }}
            <flux:link :href="route('register')" wire:navigate>{{ __('新規登録') }}</flux:link>
        </div>
    @endif
</div>
