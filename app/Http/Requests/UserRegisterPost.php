<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterPost extends FormRequest
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
            // name: 必須、128文字以内
            'name' => 'required|string|max:128',
            // email: 必須、emailフォーマット、254文字以内
            'email' => 'required|email|max:254',
            // password: 必須、72文字以内
            'password' => 'required|string|max:72',
        ];
    }
}