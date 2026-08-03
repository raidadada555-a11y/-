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

        $admin = \App\Models\AdminUser::where('login_id', $datum['login_id'])->first();
        if ($admin) {
            $check = \Illuminate\Support\Facades\Hash::check($datum['password'], $admin->password);
            echo "DB存在: OK<br>";
            echo "パスワード一致: " . ($check ? "YES" : "NO") . "<br>";
        } else {
            echo "DB存在: ユーザーなし<br>";
        }
        
        $attempt = Auth::guard('admin')->attempt($datum);
        echo "Attempt結果: " . ($attempt ? "SUCCESS" : "FAIL") . "<br>";
        exit;
    }

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        return redirect(route("admin.index"));
    }
}