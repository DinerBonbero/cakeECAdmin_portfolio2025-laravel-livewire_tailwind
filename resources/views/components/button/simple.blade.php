<button {{ $attributes->merge(['class' => 'py-1 text-white rounded-md min-[570px]:rounded-lg border-3 border-solid border-gray-200']) }} >
    {{ $message }}
</button>

{{-- ※下記の記述方法もある(x-の方が主流)
コンポーネント側
<button class="py-1 bg-red-500 text-white rounded-md min-[570px]:rounded-xl w-full border-3 border-solid border-gray-200">
    {{ $slot }}
</button>

呼びだし元
@component('components.button.red')
    商品掲載停止
@endcomponent --}}
