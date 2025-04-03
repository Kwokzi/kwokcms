<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/seeders/DatabaseSeeder.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-07 17:02:00
 * Description: 数据库填充
 */

namespace Database\Seeders;

use App\Models\System\CustomKey;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SettingsSeeder::class); //配置文件填充项
        $this->call(CustomKeysSeeder::class); //自定义配置项填充
        $this->call(UsersGroupsSeeder::class); //用户组表填充
        $this->call(UsersSeeder::class); //用户表填充
        $this->call(HtmlSnippetsSeeder::class); //代码片段表填充内置数据
    }
}
