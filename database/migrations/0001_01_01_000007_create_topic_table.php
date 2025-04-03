<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/2025_03_06_110657_create_topic_table.php
 * Created Time: 2025-03-06 19:06:57
 * Last Edit Time: 2025-03-06 19:25:22
 * Description: 专题表
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
        // 专题表
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('action', 64)->unique('action')->comment('专题标识');
            $table->string('name', 128)->comment('场景的名称');
            $table->string('slug', 128)->unique('slug')->comment('专题的URL');
            $table->string('description', 180)->comment('专题介绍');
            $table->string('title', 180)->comment('SEO使用的长标题');
            $table->longText('content')->comment('内容');
            $table->unsignedInteger('views')->default(0)->comment('总点击数');
            $table->unsignedInteger('likes')->default(0)->comment('点赞数');
            $table->unsignedInteger('comments')->default(0)->comment('评论数');
            $table->string('cover_path', 180)->nullable()->comment('封面路径');
            $table->string('tpl_name', 128)->nullable()->comment('模板名称');
            $table->tinyInteger('status')->unsigned()->default(2)->comment('状态：0-启用，1-禁用,2-草稿');
            $table->timestamps();
            $table->comment('专题表');
        });
        // 专题评论表
        Schema::create('topics_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id')->comment('专题ID');
            $table->unsignedBigInteger('user_id')->nullable()->comment('用户ID, 匿名用户为空');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('父评论ID，支持多级评论');
            $table->text('content')->comment('评论内容');
            $table->ipAddress()->comment('用户IP地址');
            $table->tinyInteger('status')->unsigned()->default(1)->comment('状态: 0-审核通过, 1-审核中, 2-屏蔽');
            $table->timestamps();
            // 外键约束
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('topics_comments')->onDelete('cascade');
            $table->index(['topic_id', 'status'], 'tid_status');
            $table->comment('专题评论表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics_comments');
        Schema::dropIfExists('topics');
    }
};
