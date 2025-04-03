<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/seeders/UsersSeeder.php
 * Created Time: 2025-03-06 12:46:48
 * Last Edit Time: 2025-03-06 14:10:31
 * Description: 用户表填充
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 初始化管理员用户
        DB::table('users')->insert([
            'group_id' => 1, // 关联管理员用户组
            'username' => 'admin',
            'password' => Hash::make('admin'), // 默认密码
            'nickname' => '超级管理员',
            'sex' => 1,
            'mobile' => '18888888888',
            'email' => 'admin@example.com',
            'signature' => '我是管理员',
            'register_ip' => '127.0.0.1',
            'last_login_ip' => '127.0.0.1',
            'experience' => 10000,
            'follow_count' => 0,
            'fans_count' => 0,
            'liked_count' => 0,
            'post_count' => 0,
            'comment_count' => 0,
            'avatar_url' => 'default-avatar.png',
            'identity' => '',
            'realname' => '超级管理员',
            'remember_token' => Str::random(60),
            'status' => 0,
            'last_post_at' => null,
            'last_comment_at' => null,
            'login_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
