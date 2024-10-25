<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * リクエストの認可ロジック
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 認可が必要な場合は適宜変更
    }

    /**
     * バリデーションルールの定義
     *
     * @return array
     */
    public function rules()
    {
        return [
            'orders' => 'required|array',
            'orders.*.book_id' => 'required|exists:books,id',
            'orders.*.quantity' => 'required|integer|min:1',
        ];
    }

    /**
     * エラーメッセージのカスタマイズ（オプション）
     *
     * @return array
     */
    public function messages()
    {
        return [
            'orders.required' => '注文情報は必須です。',
            'orders.*.book_id.required' => '本のIDは必須です。',
            'orders.*.book_id.exists' => '指定された本は存在しません。',
            'orders.*.quantity.required' => '数量は必須です。',
            'orders.*.quantity.integer' => '数量は整数で入力してください。',
            'orders.*.quantity.min' => '数量は1以上である必要があります。',
        ];
    }
}
