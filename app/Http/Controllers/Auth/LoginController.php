<?php

namespace App\Http\Controllers\Auth;

/**
 * [KwokCMS] Ver 1.0 (C) 2022: Mr.Kwok
 * FilePath: /app/Http/Controllers/Auth/LoginController.php
 * Created Time: 2025-01-16 10:18:34
 * Last Edit Time: 2025-03-19 17:24:40
 * Description: 登陆控制器
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->seo('用户登陆');
        return $this->view('auth.login');
    }
    //登陆验证
    public function login(Request $request) {}
}
