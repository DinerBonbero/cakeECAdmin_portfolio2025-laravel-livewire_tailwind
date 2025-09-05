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
        return false;
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
            'phone_number' => 'required|string|regex:^\d{2,4}-\d{2,4}-\d{4}$',
            'postal_code' => 'required|string|regex:^\d{3}-\d{4}$',
            'prefecture' => ['required', Rule::in(PrefectureConst::List)],//Ruleファサードや定数、変数などが作動するように配列に入れて文字列ルールは文字列、ファサードや定数・変数をきっちり分けて要素として扱う
            'street_address' => 'required|max:50',
            'address_detail' => 'max:50'
        ];
    }
}
