{{-- @php
if(old('image')){
    dd(old('image'));
}
@endphp --}}
<x-layouts.app.header>
    <div class="pt-5">
        <span class="text-emerald-500 text-2xl">管理者</span>
    </div>
    <div class="pt-2">
        <span class="text-xl">商品登録画面</span>
    </div>
    <div class="py-3">
        <span class="text-emerald-500">※登録された商品の画像は1:2の縦横比で出力しますのでそれを考慮したうえでアップロードしてください</span>
    </div>
    <div class="w-5/9 mx-auto">
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            {{-- enctype="multipart/form-data"をformに記述してファイルを送信できるようにする   --}}
            @csrf
            <div class="flex">
                <div class="text-center w-3/5 relative mb-2">
                    <span class="absolute top-2 left-0">添付画像</span>
                    <input type="file" name="image" accept="image/png, image/jpeg"
                        class="absolute bottom-0 left-0 w-full file:py-5 file:px-5 file:mr-10 file:bg-white file:border-1 file:border-solid file:border-gray-200 file:rounded-xl hover:file:bg-gray-100">
                    {{-- enctype="multipart/form-data"そ記述することでold()が作動しなくなるため、リクエストをvalueに記述 --}}
                </div>
                <div class="flex flex-col text-left ml-5 text-lg w-2/5">
                    <label for="name">
                        商品名
                    </label>
                    <div class="w-full">
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-4/5 bg-white border-1 border-solid border-gray-200 rounded-sm"
                            placeholder="ショートケーキ">
                    </div>
                    @error('name')
                        <span class="text-red-500 text-base">{{ $message }}</span>
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
                        <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                    {{-- @foreach ($errors->get('image') as $error)
                        <div class="error">{{ $error }}</div>
                        imageのエラー全部
                    @endforeach --}}
                </div>
            </div>
            <div class="text-left pl-2">
                @error('image')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left pt-7 pb-10 w-full">
                <label class="pl-2" for="description">商品説明</label>
                <textarea name="description" id="description" class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                    placeholder="ほのかな酸味の苺とあっさりしてコクのある生クリームを使用した、甘すぎないショートケーキです。">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                @enderror
                <div class="text-center pt-5">
                    <x-button.brown message="商品を登録" />
                </div>
            </div>
        </form>
    </div>
</x-layouts.app.header>
