<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'gender' => 'required',
            'birthday' => 'required|date',
            'phone_number' => 'required|digits_between:10,16|unique:profiles,phone_number,' . Auth::user()->profile->id,
            'address' => 'required',
            'introduction' => 'max:200',
            'avatar' => 'mimes:jpg,jpeg,gif,png|max:1048'
        ];
    }
}
