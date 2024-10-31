<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
            'book_id' => 'required|array',  // book_id は必須で配列
            // 'book_id.*' => 'exists:books,id',  // book_id の各要素が books テーブルに存在することを確認
            'amount' => 'required|array',  // amount も必須で配列
            // 'amount.*' => 'required|integer|min:1|max:30',  // 各 amount の値が 1~30の範囲の整数であることを確認
        ];
    }
}
