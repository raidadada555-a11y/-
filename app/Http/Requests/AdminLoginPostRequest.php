<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AdminLoginPostRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            "login_id" => ["required", "max:255"],
            "password" => ["required", "max:72"],
        ];
    }
}
