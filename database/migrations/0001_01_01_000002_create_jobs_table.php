<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/migrations/0001_01_01_000002_create_jobs_table.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-06 21:14:56
 * Description: 队列任务表迁移文件
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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index('queue_index')->comment('队列名称');
            $table->longText('payload')->comment('任务数据');
            $table->unsignedTinyInteger('attempts')->comment('尝试次数');
            $table->unsignedInteger('reserved_at')->nullable()->comment('保留时间');
            $table->unsignedInteger('available_at')->comment('可用时间');
            $table->unsignedInteger('created_at');
            $table->comment('队列任务表');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->comment('任务名称');
            $table->integer('total_jobs')->comment('总任务数');
            $table->integer('pending_jobs')->comment('等待任务数');
            $table->integer('failed_jobs')->comment('失败任务数');
            $table->longText('failed_job_ids')->comment('失败任务ID');
            $table->mediumText('options')->nullable()->comment('任务选项');
            $table->integer('cancelled_at')->nullable()->comment('取消时间');
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
            $table->comment('队列任务批次表');
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique('uuid')->comment('UUID');
            $table->text('connection')->comment('连接');
            $table->text('queue')->comment('队列');
            $table->longText('payload')->comment('任务数据');
            $table->longText('exception')->comment('异常信息');
            $table->timestamp('failed_at')->useCurrent()->comment('失败时间');
            $table->comment('失败任务表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
