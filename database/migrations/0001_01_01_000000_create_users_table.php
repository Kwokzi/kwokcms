<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/0001_01_01_000000_create_users_table.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-07 09:19:09
 * Description: 用户表迁移文件
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 用户组表
        Schema::create('users_groups', function (Blueprint $table) {
            $table->id()->comment('用户组ID');
            $table->string('name', 32)->comment('用户组名称');
            $table->tinyInteger('type')->default(1)->comment('用户组类型: 0=内置组, 1=自定义');
            $table->string('color', 7)->nullable()->comment('用户组颜色 (HEX 颜色码, 如 #FF5733)');
            $table->string('icon', 64)->nullable()->comment('用户组图标 URL');
            $table->json('permissions')->nullable()->comment('用户组权限 JSON');
            $table->unsignedMediumInteger('price')->default(0)->comment('用户组价格(单位: 分)');
            $table->unsignedInteger('experience')->default(0)->comment('用户组经验值');
            $table->string('description', 180)->nullable()->comment('用户组描述');
            $table->tinyInteger('status')->default(0)->comment('用户组状态: 0=正常, 1=禁用');
            $table->timestamps();
            $table->comment('用户组(* 为内置所有权限)');
        });

        // 用户表
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('用户ID');
            $table->foreignId('group_id')->constrained('users_groups')->cascadeOnDelete()->comment('用户组ID');
            $table->string('username', 64)->uniqid('username')->comment('用户名');
            $table->string('password', 128)->comment('密码');
            $table->string('nickname', 32)->nullable()->comment('昵称');
            $table->tinyInteger('sex')->unsigned()->default(2)->comment('性别(0女,1男,2未知)');
            $table->string('mobile', 20)->nullable()->uniqid('mobile')->comment('手机号码');
            $table->string('email', 128)->nullable()->uniqid('email')->comment('邮箱地址');
            $table->string('signature', 180)->nullable()->comment('个性签名');
            $table->ipAddress('register_ip')->comment('注册IP');
            $table->ipAddress('last_login_ip')->comment('最后登陆IP');
            $table->integer('experience')->default(0)->comment('经验值');
            $table->unsignedInteger('follow_count')->default(0)->comment('关注数');
            $table->unsignedInteger('fans_count')->default(0)->comment('粉丝数');
            $table->unsignedInteger('liked_count')->default(0)->comment('被点赞总数');
            $table->unsignedInteger('post_count')->default(0)->comment('投稿总数');
            $table->unsignedInteger('comment_count')->default(0)->comment('回复总数');
            $table->string('avatar_url', 64)->nullable()->comment('头像URL');
            $table->timestamp('avatar_at')->nullable()->comment('头像修改时间');
            $table->char('identity', 18)->nullable()->comment('身份证号码');
            $table->string('realname', 20)->nullable()->comment('身份证姓名');
            $table->timestamp('email_verified_at')->nullable()->comment('邮箱验证时间');
            $table->timestamp('password_updated_at')->nullable()->comment('密码修改时间');
            $table->rememberToken()->comment('记住登录状态');
            $table->tinyInteger('status')->default(0)->comment('用户状态:0正常，1禁用，2审核,3审核拒绝,4审核忽略');
            $table->timestamp('last_post_at')->nullable()->comment('最后投稿时间');
            $table->timestamp('last_comment_at')->nullable()->comment('最后评论时间');
            $table->timestamp('login_at')->nullable()->comment('最后登陆时间');
            $table->timestamps();
            $table->softDeletes(); //软删除
            $table->comment('用户表');
        });

        //用户重置密码表
        Schema::create('users_password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 128)->primary()->comment('用户邮箱');
            $table->string('token', 64)->comment('重置密码Token');
            $table->timestamp('created_at')->nullable();
            $table->comment('用户重置密码Token表');
        });

        //用户登录日志表
        Schema::create('users_sessions', function (Blueprint $table) {
            $table->string('id', 128)->primary();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable()->comment('用户代理');
            $table->text('payload')->nullable()->comment('会话数据'); //存储会话数据
            $table->integer('last_activity')->index('last_activity')->default(0)->comment('最后活动时间'); //最后活动时间
            $table->timestamps();
            $table->comment('用户登录日志表');
        });
        //用户通知表
        Schema::create('users_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type', 16)->comment('通知类型');
            $table->string('sender', 64)->nullable()->comment('发送人');
            $table->unsignedBigInteger('send_user_id')->nullable()->comment('发送人ID');
            $table->tinyInteger('notification_level')->unsigned()->default(0)->comment('通知等级(0低、1中、2高)');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->comment('被通知的用户');
            $table->string('title', 180)->comment('通知标题');
            $table->text('message')->comment('通知内容');
            $table->string('redirect_url', 180)->nullable()->comment('通知跳转');
            $table->timestamp('read_at')->nullable()->comment('是否已读');
            $table->timestamps();
            $table->softDeletes();
            //外键
            $table->foreign('send_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'read_at'], 'uid_read');
            $table->index('user_id', 'uid');
            $table->comment('用户通知表');
        });
        //用户私信表
        Schema::create('users_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id')->nullable()->comment('发送者ID');
            $table->unsignedBigInteger('receiver_id')->nullable()->comment('接收者ID');
            $table->text('message')->comment('消息内容');
            $table->timestamp('read_at')->nullable()->comment('已读时间');
            $table->tinyInteger('status')->default(0)->comment('消息状态: 0=未读, 1=已读, 2=撤回, 3=删除');
            $table->timestamps();
            $table->softDeletes();
            //外键
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('set null');
            //索引
            $table->index(['sender_id', 'receiver_id'], 'sender_receiver');
            $table->comment('用户私信表');
        });
        //用户关注表,如果取消关注：必须删除记录（DELETE FROM users_followers）。
        Schema::create('users_followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id')->comment('关注者ID');
            $table->unsignedBigInteger('following_id')->comment('被关注者ID');
            $table->tinyInteger('mutual')->default(0)->comment('是否相互关注(1-相互关注，0-单向关注)');
            $table->timestamps();
            // 确保外键表一致
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
            // 唯一索引，确保一个用户不能关注同一个人两次
            $table->unique(['follower_id', 'following_id'], 'follower_following');
            $table->comment('用户关注表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_password_reset_tokens'); //删除重置密码表
        Schema::dropIfExists('users_messages'); //删除私信表
        Schema::dropIfExists('users_sessions'); //删除登录日志表
        Schema::dropIfExists('users_followers'); //删除关注表
        Schema::dropIfExists('users_notifications'); //删除通知表
        Schema::dropIfExists('users'); //删除用户表
        Schema::dropIfExists('users_groups'); //删除用户组表
    }
};
