<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $datum = $request->validate([
            'login_id' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($datum) === false) {
            return back()
                ->withInput()
                ->withErrors([
                    'auth' => 'ログインIDかパスワードに誤りがあります。',
                ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/task/list');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->regenerateToken();
        $request->session()->regenerate();

        return redirect(route('front.index'));
    }
}