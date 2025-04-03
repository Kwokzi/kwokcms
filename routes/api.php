<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /routes/api.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-21 18:38:15
 * Description: API 路由
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterController; // 引入控制器
use Faker\Guesser\Name;

Route::get('/', function () {
    return 'api';
})->name('index');

Route::get('/count', [CounterController::class, 'getCount'])->name('count');
Route::post('/count', [CounterController::class, 'incrementCount']);
