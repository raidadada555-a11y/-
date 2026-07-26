<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterPost;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.register');
    }

    public function register(UserRegisterPost $request)
    {
        $datum = $request->validated();

        $datum['password'] = Hash::make($datum['password']);

        User::create($datum);

        $request->session()->flash('front.user_register_success', true);

        return redirect(route('front.index'));
    }
}