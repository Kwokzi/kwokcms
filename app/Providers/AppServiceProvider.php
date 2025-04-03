<?php

namespace App\Providers;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Providers/AppServiceProvider.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-07 11:03:49
 * Description: 应用程序服务提供者
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 引导应用程序服务
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // API 请求频率限制，使用方法 middleware(['throttle:api'])
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        // 所有的路由参数 id 必须是数字
        Route::pattern('id', '[0-9]+');
    }
}
