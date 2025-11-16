<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Consts\PrefectureConst;

class UserController extends Controller
{
    public function create()
    {

        $userInfo = Auth::user()->userInfo()->first();
        //Auth::user()：@return \App\Models\User|null
        // モデルのリレーションメソッドuserInfo() 　呼び出し:App\Models\User::userInfos @return：\Illuminate\Database\Eloquent\Relations\HasOne
        //$userInfo = Auth::user()->userInfo()->get();
        //userInfosレコードのみ取得,ユーザー情報は含まれない

        if (!isset($userInfo)) {
            //ログインユーザーのユーザー情報がなければ

            return view('user_info.create');
            //ユーザー情報登録画面を表示
        } else {

            return redirect()->route('items.index');
            //ユーザー情報が既に登録されている場合、商品一覧画面へリダイレクト
        }
    }

    public function store(Request $request)
    {

        $validated = $request->validate(

            [
                'last_name' => 'required|max:30',
                'first_name' => 'required|max:30',
                'phone_number' => 'required|string|regex:/^\d{2,4}-\d{2,4}-\d{4}$/',
                'postal_code' => 'required|string|regex:/^\d{3}-\d{4}$/',
                'prefecture' => ['required', Rule::in(PrefectureConst::List)], //Ruleファサードや定数、変数などが作動するように配列に入れて文字列ルールは文字列、ファサードや定数・変数をきっちり分けて要素として扱う
                'street_address' => 'required|max:50',
                'address_detail' => 'max:50'
            ],
            [
                'last_name.required' => '姓を入力してください。',
                'last_name.max' => '姓は30文字以内で入力してください。',
                'first_name.required' => '名を入力してください。',
                'first_name.max' => '名は30文字以内で入力してください。',
                'phone_number.required' => '電話番号を入力してください。',
                'phone_number.string' => '電話番号はテキストで入力してください。',
                'phone_number.regex' => '電話番号は半角数字ハイフンありの(2～4桁)-(2～4桁)-(4桁)​の形式で入力してください。',
                'postal_code.required' => '郵便番号を入力してください。',
                'postal_code.string' => '郵便番号はテキストで入力してください。',
                'postal_code.regex' => '郵便番号は半角数字ハイフンありの(3桁-4桁)の形式で入力してください。',
                'prefecture.required' => '都道府県を選択してください。',
                'prefecture.in' => 'この値は無効です、選択肢から選んでください。',
                'street_address.required' => '市区町村・番地を入力してください。',
                'street_address.max' => '市区町村・番地は50文字以内で入力してください。',
                'address_detail.max' => '建物名・部屋番号は50文字以内で入力してください。'
            ]
        );
        //フォームリクエストバリデーション、$validatedは連想配列

        Auth::user()->userInfo()->create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'phone_number' => $validated['phone_number'],
            'postal_code' => $validated['postal_code'],
            'prefecture' => $validated['prefecture'],
            'street_address' => $validated['street_address'],
            'address_detail' => $validated['address_detail'],
        ]);
        //ユーザー情報登録

        return redirect()->route('items.index');
        //商品一覧画面へリダイレクト
    }

    public function edit()
    {

        $userInfo = Auth::user()->userInfo()->first();
        // モデルのリレーションメソッド（userInfo()）

        if (isset($userInfo)) {
            //ログインユーザーのユーザー情報があれば

            return view('user_info.edit', compact('userInfo'));
            //ユーザー情報編集画面を表示かつユーザー情報を渡す
        } else {

            return redirect()->route('items.index');
            //ユーザー情報が登録されていない場合、商品一覧画面へリダイレクト
        }
    }

    public function update(Request $request)
    {

        $validated = $request->validate(

            [
                'last_name' => 'required|max:30',
                'first_name' => 'required|max:30',
                'phone_number' => 'required|string|regex:/^\d{2,4}-\d{2,4}-\d{4}$/',
                'postal_code' => 'required|string|regex:/^\d{3}-\d{4}$/',
                'prefecture' => ['required', Rule::in(PrefectureConst::List)], //Ruleファサードや定数、変数などが作動するように配列に入れて文字列ルールは文字列、ファサードや定数・変数をきっちり分けて要素として扱う
                'street_address' => 'required|max:50',
                'address_detail' => 'max:50'
            ],
            [
                'last_name.required' => '姓を入力してください。',
                'last_name.max' => '姓は30文字以内で入力してください。',
                'first_name.required' => '名を入力してください。',
                'first_name.max' => '名は30文字以内で入力してください。',
                'phone_number.required' => '電話番号を入力してください。',
                'phone_number.string' => '電話番号はテキストで入力してください。',
                'phone_number.regex' => '電話番号は半角数字ハイフンありの(2～4桁)-(2～4桁)-(4桁)​の形式で入力してください。',
                'postal_code.required' => '郵便番号を入力してください。',
                'postal_code.string' => '郵便番号はテキストで入力してください。',
                'postal_code.regex' => '郵便番号は半角数字ハイフンありの(3桁-4桁)の形式で入力してください。',
                'prefecture.required' => '都道府県を選択してください。',
                'prefecture.in' => 'この値は無効です、選択肢から選んでください。',
                'street_address.required' => '市区町村・番地を入力してください。',
                'street_address.max' => '市区町村・番地は50文字以内で入力してください。',
                'address_detail.max' => '建物名・部屋番号は50文字以内で入力してください。'
            ]
        );
        //$validatedは連想配列

        $userInfo = Auth::user()->userInfo()->first();

        $userInfo->update([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'phone_number' => $validated['phone_number'],
            'postal_code' => $validated['postal_code'],
            'prefecture' => $validated['prefecture'],
            'street_address' => $validated['street_address'],
            'address_detail' => $validated['address_detail'],
        ]);
        //ユーザー情報更新

        return redirect()->route('user_info.edit');
        //ユーザー情報編集画面へリダイレクト
    }
}

// モデルのリレーションメソッド（userInfo()）
//$userInfo = Auth::user()->userInfo()->get();
//userInfosレコードのみ取得,ユーザー情報は含まれない

//リレーションプロパティ（userInfo）
//$userInfo = Auth::user()->userInfo;
//userInfoレコードのみ取得 ユーザー情報は含まれない

//モデルから取得（UserInfo）
//$userInfo = UserInfo::where('user_id', Auth::id())->get();
//userInfosレコードのみ取得（リレーションに依存しない）
//ユーザー情報は含まれない

//モデルにwithを使って親と子を取得
//$user = UserInfo::with('user')->find(Auth::id());
//userInfosレコード＋usersレコードを同時取得
