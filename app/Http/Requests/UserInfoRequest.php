<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Consts\PrefectureConst;

class UserInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => 'required|max:30',
            'first_name' => 'required|max:30',
            'phone_number' => 'required|string|regex:/^\d{2,4}-\d{2,4}-\d{4}$/',
            'postal_code' => 'required|string|regex:/^\d{3}-\d{4}$/',
            'prefecture' => ['required', Rule::in(PrefectureConst::List)],//Ruleファサードや定数、変数などが作動するように配列に入れて文字列ルールは文字列、ファサードや定数・変数をきっちり分けて要素として扱う
            'street_address' => 'required|max:50',
            'address_detail' => 'max:50'
        ];
    }

    public function messages()
    {
        return [
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
        ];
    }
}
