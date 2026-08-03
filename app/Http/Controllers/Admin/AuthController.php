<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() { return view("admin.index"); }

    public function login(AdminLoginPostRequest $request)
    {
        $datum = $request->validated();

        $credentials = [
            'login_id' => $datum['login_id'],
            'password' => $datum['password'],
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.top'));
        }

        return back()->withErrors([
            'login' => 'ログインIDかパスワードに誤りがあります。',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        return redirect(route("admin.index"));
    }
}