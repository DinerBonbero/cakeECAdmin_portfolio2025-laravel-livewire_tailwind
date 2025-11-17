<x-layouts.app.header>
    <div class="w-10/11 min-[500px]:w-8/11 md:w-5/11 xl:w-4/11 mx-auto text-[10px] min-[360px]:text-xs min-[690px]:text-sm md:text-base">
        <div class="flex mb-7">
            <div class="ml-5 w-full">
                <p class="my-5 text-[13px] min-[360px]:text-base md:text-lg">お客様の会員情報(送り先情報など)を登録してください</p>
                <form action="{{ route('user_info.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 text-left mb-5">
                        <div>
                            <label for="last_name" class="block">
                                姓
                            </label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                class="w-full bg-white border-1 border-solid border-gray-200 rounded-sm" placeholder="苺野">
                            @error('last_name')
                                <span class="block text-rose-500 text-[10px] min-[360px]:text-xs min-[690px]:text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="first_name" class="block">
                                名
                            </label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                class="w-full bg-white border-1 border-solid border-gray-200 rounded-sm" placeholder="慶喜">
                            @error('first_name')
                                <span class="block text-rose-500 text-[10px] min-[360px]:text-xs min-[690px]:text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-left">
                        <div class="mb-5">
                            <label for="phone_number" class="block">電話番号 (ハイフンあり)</label>
                            <input type="tel" id="phone_number" name="phone_number"
                                value="{{ old('phone_number') }}"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                placeholder="090-1234-5678">
                            @error('phone_number')
                                <span class="block text-rose-500 text-[10px] min-[360px]:text-xs min-[690px]:text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="postal_code" class="block">郵便番号 (ハイフンあり)</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                placeholder="012-3456">
                            @error('postal_code')
                                <span class="block text-rose-500 text-[10px] min-[360px]:text-xs min-[690px]:text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="prefecture" class="block">都道府県</label>
                            <select name="prefecture" id="prefecture"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full">
                                <option value="">選択してください</option>
                                @foreach (App\Consts\PrefectureConst::List as $prefecture)
                                    <option value="{{ $prefecture }}"
                                        @if (old('prefecture') == $prefecture) selected @endif>
                                        {{ $prefecture }}
                                    </option>
                                @endforeach
                            </select>
                            @error('prefecture')
                                <span class="block text-rose-500 text-[10px] min-[360px]:text-xs min-[690px]:text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="street_address" class="block">市区町村・番地</label>
                            <input type="text" id="street_address" name="street_address"
                                value="{{ old('street_address') }}"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                placeholder="大阪市阿倍野区おかし村1-2-2">
                            @error('street_address')
                                <span class="block text-rose-500 text-[10px] min-[360px]:text-xs min-[690px]:text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="address_detail" class="block">建物名・部屋番号</label>
                            <input type="text" id="address_detail" name="address_detail"
                                value="{{ old('address_detail') }}"
                                class="bg-white border-1 border-solid border-gray-200 rounded-sm w-full"
                                placeholder="あまあまハイツ 175号室">
                            @error('address_detail')
                                <span class="block text-rose-500 text-[10px] min-[360px]:text-xs min-[690px]:text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mx-auto text-center w-1/5">
                        <x-button.simple message="登録" class="bg-[#e2bc96] w-full"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app.header>
