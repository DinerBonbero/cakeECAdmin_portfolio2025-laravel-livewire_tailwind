<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SalesRequest extends FormRequest
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
            ['un_shipped' => Rule::in('0')],
            ['shipped' => Rule::in('1')],
            // 'start_date' => ,
            // 'end_date' ,
            'purchaser_name' => 'max:50|string',
        ];
    }

    public function messages()
    {
        return [
            'un_shipped.required' => '姓を入力してください。',
            'shipped.string' => '姓を入力してください。',
            'purchaser_name.max' => '購入者名60文字以内で入力してください。',
        ];
    }
}
