<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/0001_01_01_000009_create_custom_keys_table.php
 * Created Time: 2025-03-06 19:40:40
 * Last Edit Time: 2025-03-07 13:44:32
 * Description: 自定义缓存字段表
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
        Schema::create('custom_keys', function (Blueprint $table) {
            $table->string('key', 32)->primary()->comment('缓存字段(变量名)');
            $table->string('note', 64)->comment('说明');
            $table->json('value')->comment('缓存字段内容');
            $table->tinyInteger('field_type')->default(1)->comment('类型(0系统1自定义)');
            $table->string('group', 32)->nullable()->index()->comment('设置分组');
            $table->tinyInteger('permissions')->default(7)->comment('权限1+2+4 (1看、2改、4删、7全)');
            $table->comment('自定义缓存字段表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_keys');
    }
};
