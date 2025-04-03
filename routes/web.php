<?php

/**
 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /routes/web.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-19 17:25:09
 * Description: 前台路由
 */

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HtmlCompressMiddleware; //压缩html

//需要压缩的路由(后台可关闭)
Route::middleware([HtmlCompressMiddleware::class])->group(function () {
    Route::get('/', App\Http\Controllers\IndexController::class);
});



Route::name('auth.')->group(function () {
    //登陆
    Route::get('login', App\Http\Controllers\Auth\LoginController::class)->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
    Route::any('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    //注册
    Route::get('register', App\Http\Controllers\Auth\RegisterController::class)->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');
});
