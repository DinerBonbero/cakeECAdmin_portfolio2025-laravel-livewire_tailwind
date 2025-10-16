<x-layouts.app.header>
    <div class="w-4/11 mx-auto">
        <div class="flex mb-7">
            <div class="ml-5 w-full">
                <p class="my-15 text-lg serif">パスワードの変更</p>
                <form action="{{ route('user_password.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="text-left text-base">
                        <div class="mb-10">
                            <label for="password" class="block">新しいパスワードを入力してください</label>
                            <input type="password" id="password" name="password"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full">
                            @error('password')
                                <span class="block text-rose-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="password_confirmation" class="block">新しいパスワードを再入力してください</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full">
                            @error('password_confirmation')
                                <span class="block text-rose-500">
                                    {{ $message }}
                                </span>
                            @enderror
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