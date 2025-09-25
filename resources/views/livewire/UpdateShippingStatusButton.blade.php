<div>
    @php
        echo 'ちゅうもんID' . $saleHistoryId;
        echo '発送状況' . $isSipped;
    @endphp
    @if ($isSipped === 1)
        <button type="submit" class="py-3 px-7 bg-red-500 text-white rounded-xl border-3 border-solid border-gray-200">
            未発送にする
        </button>
    @elseif ($isSipped === 0)
        <button type="submit" class="py-3 px-7 bg-indigo-500 text-white rounded-xl border-3 border-solid border-gray-200">
            発送済みにする
        </button>
    @endif

</div>
