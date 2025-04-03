<?php

namespace App\Models\Topic;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Topic/TopicComment.php
 * Created Time: 2025-03-07 12:27:01
 * Last Edit Time: 2025-03-07 12:28:54
 * Description: 专题评论模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicComment extends Model
{
    protected $fillable = ['topic_id', 'user_id', 'parent_id', 'content', 'ip_address', 'status'];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(TopicComment::class, 'parent_id');
    }
}
