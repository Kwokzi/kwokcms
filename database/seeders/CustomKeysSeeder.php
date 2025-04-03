<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/seeders/CustomKeysSeeder.php
 * Created Time: 2025-03-06 12:48:43
 * Last Edit Time: 2025-03-07 19:37:59
 * Description: 自定义填充内置数据
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CustomKeysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //网站首页的缓存名
        DB::table('custom_keys')->insert([
            'key' => 'cache_index',
            'note' => '网站首页',
            'value' => json_encode([
                'cache_key' => 'index',
                'duration' => 86400,
            ]),
            'field_type' => 0, // 系统字段
            'permissions' => 5, // 所有权限
            'group' => 'cache_rules',
        ]);

        //用户个人信息
        DB::table('custom_keys')->insert([
            'key' => 'cache_user_profile',
            'note' => '用户个人资料',
            'value' => json_encode([
                'cache_key' => 'user:profile:',
                'duration' => 3600,
            ]),
            'field_type' => 0,
            'permissions' => 5,
            'group' => 'cache_rules',
        ]);

        //文章分类
        DB::table('custom_keys')->insert([
            'key' => 'cache_categories',
            'note' => '文章全部分类',
            'value' => json_encode([
                'cache_key' => 'forever:categories',
                'duration' => 0,
            ]),
            'field_type' => 0,
            'permissions' => 5,
            'group' => 'cache_rules',
        ]);

        //单个文章
        DB::table('custom_keys')->insert([
            'key' => 'cache_article',
            'note' => '文章详情',
            'value' => json_encode([
                'cache_key' => 'article:',
                'duration' => 86400,
            ]),
            'field_type' => 0,
            'permissions' => 5,
            'group' => 'cache_rules',
        ]);

        //标签
        DB::table('custom_keys')->insert([
            'key' => 'cache_tag',
            'note' => '标签信息',
            'value' => json_encode([
                'cache_key' => 'tag:',
                'duration' => 86400,
            ]),
            'field_type' => 0,
            'permissions' => 5,
            'group' => 'cache_rules',
        ]);

        // 颜色数据
        $colors = [
            'skyblue'   => ['color' => '#17a2b8', 'label' => '天蓝色', 'text_color' => '#ffffff'], // 白色文字
            'info'      => ['color' => '#0DCAF0', 'label' => '淡蓝色', 'text_color' => '#000000'], // 黑色文字
            'primary'   => ['color' => '#007bff', 'label' => '深蓝色', 'text_color' => '#ffffff'], // 白色文字
            'indigo'    => ['color' => '#6610f2', 'label' => '靛蓝色', 'text_color' => '#ffffff'], // 白色文字
            'navy'      => ['color' => '#001f3f', 'label' => '藏青色', 'text_color' => '#ffffff'], // 白色文字
            'success'   => ['color' => '#28a745', 'label' => '绿色', 'text_color' => '#ffffff'], // 白色文字
            'teal'      => ['color' => '#20c997', 'label' => '青色', 'text_color' => '#000000'], // 黑色文字
            'olive'     => ['color' => '#3d9970', 'label' => '橄榄绿', 'text_color' => '#ffffff'], // 白色文字
            'warning'   => ['color' => '#ffc107', 'label' => '黄色', 'text_color' => '#000000'], // 黑色文字
            'orange'    => ['color' => '#fd7e14', 'label' => '橙色', 'text_color' => '#000000'], // 黑色文字
            'brown'     => ['color' => '#795548', 'label' => '棕色', 'text_color' => '#ffffff'], // 白色文字
            'danger'    => ['color' => '#dc3545', 'label' => '红色', 'text_color' => '#ffffff'], // 白色文字
            'maroon'    => ['color' => '#85144b', 'label' => '深红色', 'text_color' => '#ffffff'], // 白色文字
            'fuchsia'   => ['color' => '#f012be', 'label' => '紫红色', 'text_color' => '#ffffff'], // 白色文字
            'purple'    => ['color' => '#6f42c1', 'label' => '紫色', 'text_color' => '#ffffff'], // 白色文字
            'helloKity'   => ['color' => '#F8D7DA', 'label' => '少女粉', 'text_color' => '#000000'], // 黑色文字
            'pink'      => ['color' => '#e83e8c', 'label' => '粉色', 'text_color' => '#ffffff'], // 白色文字
            'black'     => ['color' => '#000000', 'label' => '黑色', 'text_color' => '#ffffff'], // 白色文字
            'dark'      => ['color' => '#343a40', 'label' => '暗黑色', 'text_color' => '#ffffff'], // 白色文字
            'gray'      => ['color' => '#6c757d', 'label' => '灰色', 'text_color' => '#ffffff'], // 白色文字
            'secondary' => ['color' => '#6c757d', 'label' => '深灰色', 'text_color' => '#ffffff'], // 白色文字
            'light'     => ['color' => '#f8f9fa', 'label' => '浅灰色', 'text_color' => '#000000'], // 黑色文字
            'white'     => ['color' => '#ffffff', 'label' => '白色', 'text_color' => '#000000'], // 黑色文字
        ];

        DB::table('custom_keys')->insert([
            'key' => 'colors',
            'note' => 'UI 可选颜色列表',
            'value' => json_encode($colors),
            'field_type' => 0, // 系统字段
            'permissions' => 5, // 所有权限
            'group' => 'styles',
        ]);
    }
}
