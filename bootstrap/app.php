<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /bootstrap/app.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-08 11:49:27
 * Description: 应用程序启动文件
 */

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            //后台管理路由定义(管理员权限验证)
            Route::middleware(['web', 'auth', \App\Http\Middleware\AdminMiddleware::class])
                ->prefix(config('auth.app_admin', 'admin')) //通过.env获取配置
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
            //API 路由定义(App\Providers\AppServiceProvider 定义了 API 请求频率限制)
            Route::middleware(['throttle:api', 'api'])
                ->prefix('api')
                ->name('api.')
                ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //全局中间件，如果仅在指定路由中使用，请在路由定义中使用 ->middleware('middlewareName')
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
