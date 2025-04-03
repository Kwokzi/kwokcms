<?php

namespace App\Http\Controllers;

/**
 * [KwokCMS] Ver 1.0 (C) 2022: Mr.Kwok
 * FilePath: /app/Http/Controllers/IndexController.php
 * Created Time: 2025-01-16 10:18:34
 * Last Edit Time: 2025-03-19 17:24:45
 * Description: 前台首页控制器
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; //使用缓存
class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->getCacheSet('cache_index'); //获取首页缓存配置
        $this->data = Cache::remember($this->cacheKey, $this->ttl, function () {
            return [];
        });
        $this->seo($this->app['seo_title'] ?? '', $this->app['seo_keywords'], $this->app['seo_description']); //设置SEO信息
        return $this->view('index');
    }
}
