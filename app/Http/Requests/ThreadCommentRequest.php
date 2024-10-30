<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadCommentRequest extends FormRequest
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
            'body' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|max:1048',
            'parent_id' => 'nullable|integer',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $redirectUrl = url()->previous() . '#add-comment';
        throw new \Illuminate\Validation\ValidationException($validator, redirect($redirectUrl)->withInput()->withErrors($validator));
    }
}
