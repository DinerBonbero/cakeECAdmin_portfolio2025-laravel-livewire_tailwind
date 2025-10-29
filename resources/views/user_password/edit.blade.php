<x-layouts.app.header>
    <div class="w-9/11 min-[690px]:w-7/11 lg:w-4/11 mx-auto">
        <div class="flex mb-7">
            <div class="ml-5 w-full">
                <p class="my-15 text-[13px] min-[360px]:text-base md:text-2xl serif ">パスワードの変更</p>
                <form action="{{ route('user_password.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="text-left text-base">
                        <div class="mb-10">
                            {{-- autocomplete="off"ではクロムの場合便利さを優先して自動入力拒否が効かないことが多い --}}
                            {{-- 自動入力を拒否したいときautocomplete="new-password"を設定するのが効果的。『新しいパスワードの入力欄』とブラウザに伝えることで、既存のパスワード自動入力を抑制 --}}
                            <label for="password" class="block text-[10px] min-[360px]:text-xs min-[690px]:text-sm md:text-base">新しいパスワードを入力してください</label>
                            <input type="password" id="password" name="password" class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                autocomplete="new-password">
                            @error('password')
                                <span class="block text-rose-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="password_confirmation" class="block text-[10px] min-[360px]:text-xs min-[690px]:text-sm md:text-base">新しいパスワードを再入力してください</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="mx-auto text-center">
                        <x-button.brown message="更新する" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app.header>
