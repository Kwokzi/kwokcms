<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/0001_01_01_000001_create_cache_table.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-06 21:15:00
 * Description: 缓存表迁移文件
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
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary()->comment('缓存键');
            $table->mediumText('value')->comment('缓存值');
            $table->integer('expiration')->comment('过期时间');
            $table->comment('缓存表');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner')->comment('锁拥有者');
            $table->integer('expiration')->comment('过期时间');
            $table->comment('缓存锁表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
