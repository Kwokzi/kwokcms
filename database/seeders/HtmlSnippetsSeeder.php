<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/seeders/HtmlSnippetsSeeder.php
 * Created Time: 2025-03-06 12:48:43
 * Last Edit Time: 2025-03-06 19:04:01
 * Description: 代码片段表填充内置数据
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HtmlSnippetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $snippets = [
            ['key' => 'ad_header', 'value' => '', 'description' => '顶部广告位', 'type' => 1],
            ['key' => 'ad_footer', 'value' => '', 'description' => '底部广告位', 'type' => 1],
            ['key' => 'ad_list', 'value' => '', 'description' => '列表广告位', 'type' => 1],
            ['key' => 'ad_detail', 'value' => '', 'description' => '详情广告位', 'type' => 1],
            ['key' => 'ad_sider', 'value' => '', 'description' => '侧方广告位', 'type' => 1],
            ['key' => 'web_header_code', 'value' => '', 'description' => '头部HTML代码', 'type' => 1],
            ['key' => 'web_footer_code', 'value' => '', 'description' => '脚部HTML代码', 'type' => 1],
            ['key' => 'web_tongji', 'value' => '', 'description' => 'PC统计代码', 'type' => 1],
        ];

        DB::table('html_snippets')->insert($snippets);
    }
}
