<?php

namespace App\Http\Admin;

/**
 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Http/Admin/Controller.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-19 17:25:20
 * Description: 后台管理控制器基类
 */

use Illuminate\Support\Facades\Auth;
use App\Traits\Helpers;

abstract class Controller
{
    use Helpers;
    protected array $data; //返回数据
    protected array $app; //网站配置
    protected string $cacheKey; //缓存key
    protected int $duration = 0; //缓存时间
    protected int $page = 1; //页码
    protected int $perpage = 30; //每页显示数
    protected array $result = ['status' => 'error', 'msg' => '', 'data' => []]; //response 返回统一的json
    protected array $appends = []; //分页额外参数

    //初始化类
    public function __construct()
    {
        $this->app = $this->settings(); //获取到网站配置信息
    }

    //返回视图
    protected function view(string $view)
    {
        $this->data['user'] = Auth::user();
        $this->data['colors'] = $this->custom_key('colors'); //获取系统可用颜色
        return view($view, $this->data, $this->app); //将数据交给视图处理
    }
}
