<?php

namespace App\Http\Controllers\Auth;

/**
 * [KwokCMS] Ver 1.0 (C) 2022: Mr.Kwok
 * FilePath: /app/Http/Controllers/Auth/RegisterController.php
 * Created Time: 2025-01-16 10:18:34
 * Last Edit Time: 2025-03-19 17:24:34
 * Description: 注册控制器
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        return $this->view('user.register');
    }
    //注册
    public function register(Request $request) {}
}
