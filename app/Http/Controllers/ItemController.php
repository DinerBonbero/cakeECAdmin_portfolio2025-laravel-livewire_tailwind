<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{

    public function index()
    {

        $items = Item::where('is_pending', 0)
            ->orderBy('id', 'asc')
            ->paginate(6);

        return view('items.index', compact('items'));
    }

    public function create()
    {

        return view('items.create');
    }

    public function store(Request $request)
    {

        //imageは$_FILESで送信されるため、dd()でみたときは別の形でデータが入っていることに注意

        $validated = $request->validate(

            [
                'image' => 'required|file|image|mimes:jpeg,png,jpg|max:1800', // 画像のバリデーション
                'name' => 'required|max:15',
                'price' => 'required|integer|min:300|max:10000',
                'description' => 'required|max:50'
            ],
            [
                'image.required' => '画像は必須です。',
                'image.file' => '画像を送信してください。',
                'image.image' => '画像を送信してください。',
                'image.mimes' => '画像は拡張子がjpeg,png,jpgのものを送信してください。',
                'image.max' => '画像のサイズは1800KB以内にしてください。',
                'name.required' => '商品名は必須項目です。',
                'name.max' => '商品名は15文字以内で入力してください。',
                'price.required' => '金額(税込み)は必須項目です。',
                'price.integer' => '金額(税込み)は整数で入力してください。',
                'price.min' => '金額(税込み)は300円以上で入力してください',
                'price.max' => '金額(税込み)は10,000円以下で入力してください',
                'description.required' => '商品説明は必須項目です。',
                'description.max' => '商品説明は50文字以内で入力してください。'
            ]
        );

        $validatedImage = $validated['image'];

        $originalImageName = $validatedImage->getClientOriginalName();//アップロードされたファイルの元の名前を取得

        $validatedImage->storeAs('images', $originalImageName, 'public');
        // <input type="file" name="image" />から渡される値を受け取るにはfile('name属性')関数を使用する
        //　$request->imageではなく$request->file('image')で受け取る※phpの$_FILEに該当
        //　文字の送信ではなくファイルの送信になるため同じrequestの受け取り方が異なる
        //　それが嫌であれば$validated['image'];のように配列で返ってきたバリデーションした値を使用する

        Item::create(

            [
                'image' => $originalImageName,
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $validated['description']
            ]
        );

        return redirect()->route('items.index');
    }

    public function show(Item $item)
    {

        return view('items.show', compact('item'));
    }

    public function destroy(Item $item)
    {

        try {

            DB::transaction(function () use ($item) {

                Item::where('id', $item->id)->update(['is_pending' => 1]); //該当商品の掲載停止

                Cart::where('item_id', $item->id)->delete();
            }, 5);
        } catch (\Exception $e) {

            Log::error('商品掲載停止処理中のエラー' . $e);
            return redirect()->route('errors.error');
        }

        return redirect()->route('items.index');
    }
}