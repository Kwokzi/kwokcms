<?php

namespace App\Traits;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Traits/Helpers.php
 * Created Time: 2025-02-12 21:51:13
 * Last Edit Time: 2025-03-09 11:31:27
 * Description: 助手函数(多控制器及模型会用到)
 */

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;
use App\Models\System\Setting;

trait Helpers
{
    // 通过$key 从缓存/数据表settings返回配置值
    protected function settings($key = null)
    {
        static $settings;
        if (is_null($settings)) {
            $settings = Cache::rememberForever('forever:settings', function () {
                return Arr::pluck(Setting::all(['key', 'value']), 'value', 'key');
            });
        }
        return is_null($key) ? $settings : ($settings[$key] ?? '');
    }
    /**
     * 从 custom_keys 表获取并缓存自定义值(当$group不为空时强制返回整个group而不是单个key)
     *
     * @param string $key    具体的 key (如 'colors')，如果不传，则返回整个 group 数据
     * @param string $group  数据分组 (如 'styles')
     * @return mixed         查询到的数据（单个值或整个分组）
     */
    protected function custom_key(string $key = '', string $group = '')
    {
        // 获取缓存数据，若无则查询数据库并存入缓存
        $datas = Cache::rememberForever('forever:custom:keys', function () {
            return \App\Models\System\CustomKey::get(['group', 'key', 'value'])->toArray();
        });
        // 如果指定了 group，则筛选出该 group 下的所有键值(不管有没有Key)
        if (!empty($group)) {
            $groupedData = [];
            foreach ($datas as $item) {
                if ($item['group'] === $group) {
                    $groupedData[$item['key']] = $item['value'];
                }
            }
            return $groupedData;
        }
        // 处理数据为 ['key' => 'value'] 
        $formattedData = [];
        foreach ($datas as $item) {
            $formattedData[$item['key']] = $item['value'];
        }
        // 返回指定 key 的值，否则返回所有数据
        return empty($key) ? $formattedData : ($formattedData[$key] ?? null);
    }

    /**
     * 生成缓存所需要的 Key 及过期时间数组
     *      
     * @param string $name  缓存名称（如 article, user_profile）
     * @param array $params 追加的参数 (如 ['id',123] = id:123)
     * @return void 直接更新 $this->cacheKey 和 $this->duration
     * @throws \Exception
     */
    protected function getCacheSet(string $name, array $params = []): void
    {
        // 从数据库获取缓存规则（custom_keys 表中的 "cache_rules" 记录）
        $cacheRules = $this->custom_key('', 'cache_rules');
        // 查找对应的缓存规则
        if (!isset($cacheRules[$name])) {
            throw new \Exception("缓存规则未定义: {$name}");
        }
        $cacheData = $cacheRules[$name];
        // 确保 cache_key 存在(来源于缓存规则，数据固定格式)
        if (empty($cacheData['cache_key'])) {
            throw new \Exception("缓存规则 {$name} 缺少 cache_key");
        }
        // 处理缓存 Key 的参数(数组转字符串)
        $this->cacheKey = 'web:' . $cacheData['cache_key'] . implode(':', $params); //统一加前缀，避免 Key 冲突
        $this->ttl = $cacheData['duration'] ?? 3600; // 默认 3600 秒（1 小时）
    }

    //API 返回标准格式
    protected function api_response($http_code = 200)
    {
        return response()->json($this->result, $http_code);
    }
}
