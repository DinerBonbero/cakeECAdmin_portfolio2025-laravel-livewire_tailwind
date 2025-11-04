<x-layouts.app.header>
    <div class="pt-5">
        <span class="text-emerald-500 text-2xl">管理者</span>
    </div>
    <div class="pt-2">
        <span class="text-base sm:text-xl">商品登録画面</span>
    </div>
    <div class="py-3 w-4/5 sm:w-full mx-auto">
        <span class="text-emerald-500 text-xs sm:text-xl">※登録された商品の画像は1:2の縦横比で出力しますのでそれを考慮したうえでアップロードしてください</span>
    </div>
    <div class="w-15/16 min-[420px]:w-7/9 md:w-5/9 mx-auto">
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            {{-- enctype="multipart/form-data"をformに記述してファイルを送信できるようにする   --}}
            @csrf
            <div class="flex">
                <div class="w-3/5 text-xs sm:text-sm flex flex-col">
                    <span class="text-left text-xs sm:text-base">添付画像</span>
                    <input type="file" name="image" accept="image/png, image/jpeg, image/jpg"
                        class="mt-13 w-full file:cursor-pointer file:py-2 sm:file:py-5 file:px-1 sm:file:px-5 file:mr-2 sm:file:mr-5 file:bg-white file:border-1 file:border-solid file:border-gray-200 file:rounded-md sm:file:rounded-xl hover:file:bg-gray-100">
                    {{-- enctype="multipart/form-data"を記述することでold()が作動しなくなるため、リクエストをvalueに記述 --}}
                    @error('image')
                        <div class="text-left pl-2">
                            <span class="text-red-500 text-xs min-[420px]:text-sm">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col text-left ml-0 sm:ml-5 text-xs sm:text-base md:text-lg w-2/5">
                    <label for="name">
                        商品名
                    </label>
                    <div class="w-full">
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-4/5 bg-white border-1 border-solid border-gray-200 rounded-sm"
                            placeholder="ショートケーキ">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-xs min-[420px]:text-sm">{{ $message }}</span>
                    @enderror
                    <label class="mt-2" for="price">
                        金額税込み
                    </label>
                    <div class="w-full">
                        <input type="number" name="price" id="price" value="{{ old('price') }}"
                            class="w-4/5 bg-white border-1 border-solid border-gray-200 rounded-sm mr-2"
                            placeholder="480" min="300" max="10000" step="10">円
                    </div>
                    @error('price')
                        <span class="text-red-500 text-xs min-[420px]:text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="text-left pt-7 pb-10 w-full text-sm sm:text-base">
                <label class="pl-2" for="description">商品説明</label>
                <textarea name="description" id="description" class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                    placeholder="ほのかな酸味の苺とあっさりしてコクのある生クリームを使用した、甘すぎないショートケーキです。">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-xs min-[420px]:text-sm">{{ $message }}</span>
                @enderror
                <div class="text-center pt-5">
                    <x-button.brown message="商品を登録" />
                </div>
            </div>
        </form>
    </div>
</x-layouts.app.header>
