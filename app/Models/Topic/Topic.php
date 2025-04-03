<?php

namespace App\Models\Topic;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Topic/Topic.php
 * Created Time: 2025-03-07 12:26:14
 * Last Edit Time: 2025-03-07 12:27:27
 * Description: 专题模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    protected $fillable = ['action', 'name', 'slug', 'description', 'title', 'content', 'views', 'likes', 'comments', 'cover_path', 'tpl_name', 'status'];
    public function comments(): HasMany
    {
        return $this->hasMany(TopicComment::class);
    }
}
