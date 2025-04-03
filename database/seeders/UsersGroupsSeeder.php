<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/seeders/UsersGroupsSeeder.php
 * Created Time: 2025-03-06 12:48:43
 * Last Edit Time: 2025-03-06 18:58:44
 * Description: 用户组表填充
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class UsersGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 初始化用户组
        DB::table('users_groups')->insert([
            [
                'id' => 1,
                'name' => '超级管理员组',
                'type' => -1, // 内置用户组
                'color' => null,
                'icon' => null,
                'permissions' => json_encode(['*']), // 拥有所有权限
                'price' => 0,
                'experience' => 0,
                'description' => '拥有系统管理的最高权限用户组',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => '管理员',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode(['*']),
                'price' => 0,
                'experience' => 0,
                'description' => '网站普通管理员组',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => '游客组',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode([]), // 没有任何权限
                'price' => 0,
                'experience' => 0,
                'description' => '网站普通访客组',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => '禁止访问',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode([]), // 没有任何权限
                'price' => 0,
                'experience' => 0,
                'description' => '禁止访问网站内容的用户组',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => '禁止发言',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode([]), // 没有任何权限
                'price' => 0,
                'experience' => 0,
                'description' => '禁言用户(不能投稿、评论等)',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => '待审核',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode([]), // 没有任何权限
                'price' => 0,
                'experience' => 0,
                'description' => '正在等待审核的新注册会员(系统设置是否开启)',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => '网站编辑',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode(['web_editor']), //拥有所有权限
                'price' => 0,
                'experience' => 0,
                'description' => '网站编辑(员工)',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 88,
                'name' => '贵宾VIP',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode(['vip_super']), // 拥有所有权限
                'price' => 3000,
                'experience' => 30,
                'description' => '超级VIP用户',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 99,
                'name' => 'VIP',
                'type' => -1,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode(['vip_user']), // 拥有所有权限
                'price' => 2000,
                'experience' => 30,
                'description' => 'VIP用户',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 100,
                'name' => '小学生',
                'type' => 0, // 自定义用户组
                'color' => null,
                'icon' => null,
                'permissions' => json_encode([]), // 没有任何权限
                'price' => 0,
                'experience' => 10,
                'description' => '初始等级会员',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 101,
                'name' => '初中生',
                'type' => 0,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode([]), // 没有任何权限
                'price' => 0,
                'experience' => 200,
                'description' => '中等级会员',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 102,
                'name' => '高中生',
                'type' => 0,
                'color' => null,
                'icon' => null,
                'permissions' => json_encode([]), // 没有任何权限
                'price' => 0,
                'experience' => 1000,
                'description' => '高等级会员',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
