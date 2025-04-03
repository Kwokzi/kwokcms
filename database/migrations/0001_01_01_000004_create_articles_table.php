<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/0001_01_01_000004_create_articles_table.php
 * Created Time: 2025-03-06 14:27:52
 * Last Edit Time: 2025-03-06 21:14:48
 * Description: 文章相关表迁移文件
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
        // 文章分类表   
        Schema::create('articles_categories', function (Blueprint $table) {
            $table->smallIncrements('id')->primary()->unsigned()->comment('分类ID');
            $table->unsignedSmallInteger('up_id')->nullable()->comment('上级分类');
            $table->string('name', 64)->notNullable()->comment('分类名');
            $table->string('slug', 64)->unique('slug_unique')->comment('自定义URL');
            $table->string('icon', 128)->nullable()->comment('分类图标');
            $table->string('description', 180)->default('')->comment('分类描述');
            $table->string('title', 180)->nullable()->comment('重定义title，用于seo');
            $table->unsignedSmallInteger('order')->default(0)->index('order')->comment('显示顺序');
            $table->string('tpl', 64)->nullable()->comment('定义分类使用模板');
            $table->string('articles_tpl', 64)->nullable()->comment('当前分类下的文章显示模板');
            $table->unsignedTinyInteger('perpage')->default(30)->comment('每页显示多少条');
            $table->unsignedTinyInteger('status')->default(1)->comment('分类状态：1-显示，0-隐藏');
            $table->timestamps();
            $table->foreign('up_id')->references('id')->on('articles_categories')->onDelete('cascade');
            $table->comment('文章分类表');
        });
        // 文章表
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('catid')->index('cid')->comment('分类ID');
            $table->unsignedBigInteger('user_id')->index('uid')->comment('用户ID');
            $table->string('username', 64)->default('')->comment('用户名');
            $table->string('subject', 180)->comment('标题');
            $table->longText('content')->comment('文章内容');
            $table->string('slug', 180)->nullable()->unique('slug_unique')->comment('自定义URL');
            $table->text('excerpt')->nullable()->comment('文章摘要');
            $table->ipAddress()->comment('发布IP');
            $table->unsignedTinyInteger('is_anonymous')->default(0)->comment('匿名开关(0显示，1隐藏名字)');
            $table->unsignedTinyInteger('is_top')->default(0)->comment('置顶开关');
            $table->unsignedTinyInteger('allow_reply')->default(1)->comment('评论开关');
            $table->timestamp('digest_at')->nullable()->comment('加入精华时间');
            $table->timestamp('top_at')->nullable()->comment('站长推荐时间');
            $table->uuid('uuid')->unique('uuid_unique')->comment('UUID与附件关联');
            $table->string('cover_path', 180)->nullable()->comment('封面路径');
            $table->string('source_url', 180)->nullable()->comment('来源URL');
            $table->string('author', 128)->nullable()->comment('原作者');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：1-发布，0-草稿,2-登录可见, 3-VIP可见');
            $table->timestamp('published_at')->index('published')->nullable()->comment('发布时间');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('catid')->references('id')->on('articles_categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->comment('文章表');
        });
        //文章评论表
        Schema::create('articles_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->constrained('articles')->cascadeOnDelete()->comment('关联文章ID');
            $table->unsignedBigInteger('reply_comment_id')->nullable()->comment('回复评论的ID');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('上级评论ID，支持无限级');
            $table->unsignedBigInteger('reply_user_id')->nullable()->comment('回复用户的ID');
            $table->unsignedBigInteger('user_id')->nullable()->comment('评论发布ID');
            $table->string('username', 64)->default('')->comment('评论的用户名');
            $table->ipAddress()->comment('发表IP');
            $table->text('content')->comment('评论内容');
            $table->unsignedInteger('agree_count')->default(0)->comment('顶');
            $table->unsignedInteger('diss_count')->default(0)->comment('踩');
            $table->unsignedTinyInteger('is_anonymous')->default(0)->comment('匿名开关(0显示，1隐藏名字)');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态(0正常，1审核，2审核未通过)');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('reply_comment_id')->references('id')->on('articles_comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('article_id', 'aid');
            $table->comment('文章评论表');
        });
        //文章信息统计表
        Schema::create('articles_counts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->comment('文章ID');
            $table->unsignedInteger('daily_views')->default(0)->comment('日点击');
            $table->unsignedInteger('weekly_views')->default(0)->comment('周点击');
            $table->unsignedInteger('monthly_views')->default(0)->comment('月点击');
            $table->unsignedInteger('all_views')->default(0)->comment('总点击');
            $table->unsignedInteger('daily_comments')->default(0)->comment('日评论数');
            $table->unsignedInteger('weekly_comments')->default(0)->comment('周评论数');
            $table->unsignedInteger('monthly_comments')->default(0)->comment('月评论数');
            $table->unsignedInteger('all_comments')->default(0)->comment('总评论数');
            $table->unsignedInteger('daily_likes')->default(0)->comment('日点赞数');
            $table->unsignedInteger('weekly_likes')->default(0)->comment('周点赞数');
            $table->unsignedInteger('monthly_likes')->default(0)->comment('月点赞数');
            $table->unsignedInteger('all_likes')->default(0)->comment('总点赞数');
            $table->unsignedInteger('daily_dislikes')->default(0)->comment('日不喜欢数');
            $table->unsignedInteger('weekly_dislikes')->default(0)->comment('周不喜欢数');
            $table->unsignedInteger('monthly_dislikes')->default(0)->comment('月不喜欢数');
            $table->unsignedInteger('all_dislikes')->default(0)->comment('总不喜欢数');
            $table->unsignedInteger('daily_collections')->default(0)->comment('日收藏数');
            $table->unsignedInteger('weekly_collections')->default(0)->comment('周收藏数');
            $table->unsignedInteger('monthly_collections')->default(0)->comment('月收藏数');
            $table->unsignedInteger('all_collections')->default(0)->comment('总收藏数');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('articles')->onDelete('cascade');
            $table->index(['daily_views', 'weekly_views', 'monthly_views', 'all_views'], 'views');
            $table->index(['daily_comments', 'weekly_comments', 'monthly_comments', 'all_comments'], 'comments');
            $table->index(['daily_likes', 'weekly_likes', 'monthly_likes', 'all_likes'], 'likes');
            $table->index(['daily_dislikes', 'weekly_dislikes', 'monthly_dislikes', 'all_dislikes'], 'dislikes');
            $table->index(['daily_collections', 'weekly_collections', 'monthly_collections', 'all_collections'], 'collections');
            $table->comment('文章信息统计表');
        });

        //文章附件表
        Schema::create('articles_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->index('aid')->nullable()->comment('文章关联ID');
            $table->uuid('uuid')->nullable()->comment('与文章绑定');
            $table->unsignedBigInteger('user_id')->index('uid')->nullable()->comment('用户关联ID');
            $table->string('description', 180)->default('')->comment('附件说明');
            $table->string('file_type', 128)->comment('文件类型');
            $table->unsignedInteger('file_size')->default(0)->comment('文件大小');
            $table->string('file_name', 180)->default('')->comment('文件原名称');
            $table->unsignedTinyInteger('is_image')->default(0)->comment('是否图片');
            $table->string('file_path', 180)->default('')->comment('服务器相对路径');
            $table->ipAddress()->comment('上传者IP');
            $table->boolean('is_remote')->default(false)->comment('是否远程下载的附件');
            $table->string('mime_type', 128)->nullable()->comment('MIME类型');
            $table->string('storage_type', 64)->nullable()->comment('存储类型(本地、阿里云)');
            $table->timestamps();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->comment('文章附件表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_comments'); //文章评论表
        Schema::dropIfExists('articles_counts'); //文章信息统计表
        Schema::dropIfExists('articles_attachments'); //文章附件表
        Schema::dropIfExists('articles'); //文章表
        Schema::dropIfExists('articles_categories'); //文章分类表
    }
};
