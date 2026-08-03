<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterPost extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            // name: 必須、128文字以内
            'name' => 'required|string|max:128',
            // login_id: 必須、文字列、255文字以内（必要に応じてuniqueなどのルールも追加可能よ）
            'login_id' => 'required|string|max:255',
            // password: 必須、72文字以内
            'password' => 'required|string|max:72',
        ];
    }
}