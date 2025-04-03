<?php

/**
 * Copyright (C) 2025 Chongqing Enzu Technology Co., LTD
 * [KwokCMS] Ver 1.0 (C) 2025 Mr.Kwok
 * FilePath: /database/migrations/0001_01_01_000003_create_settings_table.php
 * Created Time: 2025-03-06 10:50:43
 * Last Edit Time: 2025-03-06 21:14:52
 * Description: 系统配置表迁移文件
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 迁移运行的逻辑
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key', 32)->primary()->comment('配置的主键'); // 主键
            $table->text('value')->comment('配置对应的值');
            $table->string('note', 180)->default('')->comment('配置的说明');
        });
    }

    /**
     * 迁移回滚的逻辑（删除整个表）
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
