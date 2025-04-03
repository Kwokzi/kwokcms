<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /routes/admin.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-07 10:29:14
 * Description: 后台管理 路由
 */

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'admin';
})->name('index');
