<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/2025_03_06_105001_create_html_snippets_table.php
 * Created Time: 2025-03-06 18:50:01
 * Last Edit Time: 2025-03-06 18:58:20
 * Description: HTML代码片段表
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
        Schema::create('html_snippets', function (Blueprint $table) {
            $table->string('key')->unique()->comment('代码片段标识符');
            $table->longText('value')->comment('HTML代码');
            $table->text('description')->nullable()->comment('代码片段描述(位置、用途等)');
            $table->tinyInteger('type')->default(0)->comment('类别：0-自定义，1-系统内置');
            $table->tinyInteger('status')->default(0)->comment('状态：0-启用，1-禁用');
            $table->timestamps();
            $table->comment('HTML代码片段表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('html_snippets');
    }
};
