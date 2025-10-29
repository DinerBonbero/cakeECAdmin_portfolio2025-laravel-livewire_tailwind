<button class="py-1 @can('user') bg-[#7cc7f4] @else @guest bg-gray-300  @endguest @endcan text-white rounded-md min-[570px]:rounded-xl w-full border-3 border-solid border-gray-200" @guest disabled @endguest>
    カートに入れる
</button>