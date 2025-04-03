<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/0001_01_01_000008_create_friendlinks_table.php
 * Created Time: 2025-03-06 19:26:53
 * Last Edit Time: 2025-03-06 21:15:16
 * Description: 友情链接表
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
        Schema::create('friend_links', function (Blueprint $table) {
            $table->smallIncrements('id')->unsigned()->primary();
            $table->string('name')->comment('网站名称');
            $table->string('url', 180)->comment('网站地址');
            $table->string('logo', 180)->nullable()->comment('网站LOGO');
            $table->string('description', 180)->nullable()->comment('网站描述');
            $table->smallInteger('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态：0-显示，1-隐藏');
            $table->string('remarks', 180)->nullable()->comment('备注（友情链接，合作伙伴...）');
            $table->timestamps();
            $table->comment('友情链接表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friend_links');
    }
};
