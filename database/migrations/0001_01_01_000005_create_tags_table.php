<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/2025_03_06_095657_create_tags_table.php
 * Created Time: 2025-03-06 17:56:57
 * Last Edit Time: 2025-03-06 19:23:41
 * Description: 标签关联表
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
        // 标签表
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tagname', 64)->unique('tagname')->comment('标签名称');
            $table->string('slug', 128)->nullable()->unique('slug')->comment('自定义URL');
            $table->string('description', 180)->nullable()->comment('标签描述');
            $table->string('title', 180)->nullable()->comment('重定义title，用于seo');
            $table->tinyInteger('status')->default(0)->comment('状态：0-启用，1-禁用');
            $table->timestamps();
            $table->comment('标签表');
        });
        // 标签关联表
        Schema::create('tag_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id')->comment('标签ID');
            $table->unsignedBigInteger('taggable_id')->comment('关联ID');
            $table->string('taggable_type', 180)->comment('关联类型');
            $table->unique(['tag_id', 'taggable_id', 'taggable_type'], 'taggable');
            $table->index(['tag_id', 'taggable_id'], 'tag_taggable');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->comment('标签关联表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags'); //删除标签表
        Schema::dropIfExists('tag_maps'); //删除标签关联表
    }
};
