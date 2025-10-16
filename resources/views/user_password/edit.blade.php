<x-layouts.app.header>
    <div class="w-4/11 mx-auto">
        <div class="flex mb-7">
            <div class="ml-5 w-full">
                <p class="my-15 text-lg">パスワードの変更</p>
                <form action="{{ route('user_password.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="text-left text-base">
                        <div class="mb-10">
                            <label for="phone_number" class="block">新しいパスワードを入力してください</label>
                            <input type="tel" id="phone_number" name="phone_number"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                placeholder="090-1234-5678">
                            @error('phone_number')
                                <span class="block text-rose-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="postal_code" class="block">新しいパスワードを再入力してください</label>
                            <input type="text" id="postal_code" name="postal_code"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                placeholder="012-3456">
                            @error('postal_code')
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