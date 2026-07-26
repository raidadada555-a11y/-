<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRegisterPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:128'],
            'period' => ['required', 'date'],
            'detail' => ['nullable', 'max:65535'],
            'priority' => ['required'],
        ];
    }
}