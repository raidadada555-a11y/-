<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'admin_users';

    protected $fillable = [
        "login_id",
        "password",
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'login_id';
    }

    // 👇 パスワードの格納カラムを明示する！
    public function getAuthPasswordName()
    {
        return 'password';
    }
}