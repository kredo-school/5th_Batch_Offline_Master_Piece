<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Author;


class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_date' => 'required|date',
            'publisher' => 'required|string|max:255',
            'isbn_code' => 'required|string|max:13', // ISBNコードの最大長13文字
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像ファイル（オプション）

            'name' => 'required|string|max:255', 
            
            'genres' => 'required|array', // 複数のジャンルが配列で送信されることを期待
            'genres.*' => 'exists:genres,id' // 各ジャンルがデータベースに存在するかチェック
        ];
    }

    public function getAuthor()
    {
        // 著者名で検索
        $author = Author::where('name', $this->input('name'))->first();

        // 既に存在している場合はそれを返す
        if ($author) {
            return $author;
        }

        // 存在しない場合は新規に作成
        return Author::create(['name' => $this->input('name')]);
    }
}
