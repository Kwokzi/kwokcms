<?php

namespace App\Http\Controllers;

/**
 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Http/Controllers/Controller.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-19 21:33:27
 * Description: 前端控制器基类
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Traits\Helpers;
use Illuminate\Support\Str;

abstract class Controller
{
    use Helpers;

    /**
     * 构造函数
     * 
     * @param array $data 视图数据
     * @param array $app 网站配置
     * @param string $cacheKey 缓存key
     * @param int $ttl 缓存时间（秒）
     * @param int $page 当前页码
     * @param int $perpage 每页显示数
     * @param array $result API响应结果
     * @param array $appends 分页额外参数
     */
    public function __construct(
        protected array $data = [],
        protected array $app = [],
        protected string $cacheKey = '',
        protected int $ttl = 0,
        protected int $page = 1,
        protected int $perpage = 30,
        protected array $result = ['status' => 'error', 'msg' => '', 'data' => []],
        protected array $appends = []
    ) {
        $this->app = $this->settings(); // 获取网站配置信息
    }

    /**
     * 返回视图
     *
     * @param string $view 视图名称
     * @return \Illuminate\Http\Response
     */
    protected function view(string $view): Response
    {
        $this->data['user'] = Auth::user();
        $this->data['colors'] = $this->custom_key('colors'); // 获取系统可用颜色
        $this->data['current_url'] = request()->url(); // 当前URL
        // 设置响应对象、预处理视图数据
        $response = response()->view($view, array_merge($this->data, $this->app));
        // 如果需要缓存，设置相应的HTTP头
        if ($this->ttl > 0) {
            $response->withHeaders(['Cache-Control' => "max-age={$this->ttl}, public"]);
        }
        return $response;
    }

    /**
     * 设置 SEO 相关信息
     *
     * @param string $title 标题
     * @param string|null $keywords 关键词（可选）
     * @param string|null $description 描述（可选）
     * @return void
     */
    protected function seo(string $title, ?string $keywords = null, ?string $description = null): void
    {
        // 处理标题，防止 XSS
        $cleanTitle = trim(strip_tags($title));
        $this->data['web_title'] = htmlspecialchars_decode($cleanTitle . ($this->app['seo_title_append'] ?? ''));

        // 处理关键词
        if (empty($keywords)) {
            // 用标题作为默认关键词，并清理特殊字符
            $keywords = str_ireplace(
                [
                    $this->app['web_name'] ?? '',
                    $this->app['seo_title_append'] ?? '',
                    '_',
                    '-',
                    '，',
                    '。',
                    '、',
                    '|',
                    ',,'
                ],
                ',',
                $cleanTitle
            );
        }
        $this->data['web_keywords'] = trim($keywords, ',');
        // 处理描述，防止 XSS，去除换行符，并限制长度（180 字符）
        if (!empty($description)) {
            $cleanDescription = str_replace(["\r", "\n", "\t"], '', trim(strip_tags($description)));
            $this->data['web_description'] = Str::limit($cleanDescription, 180);
        } else {
            $this->data['web_description'] = '';
        }
    }
}
