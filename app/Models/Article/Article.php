<?php

namespace App\Models\Article;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Article/Article.php
 * Created Time: 2025-03-07 12:33:07
 * Last Edit Time: 2025-03-07 13:01:57
 * Description: 文章模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User\User;

class Article extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'catid',
        'user_id',
        'username',
        'subject',
        'content',
        'slug',
        'excerpt',
        'is_anonymous',
        'is_top',
        'allow_reply',
        'digest_at',
        'top_at',
        'uuid',
        'cover_path',
        'source_url',
        'author',
        'status',
        'published_at',
        'ip_address',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'digest_at' => 'datetime',
        'top_at' => 'datetime',
    ];
    //文章分类
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticlesCategory::class, 'catid');
    }
    //文章作者
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //文章评论
    public function comments(): HasMany
    {
        return $this->hasMany(ArticlesComment::class, 'article_id');
    }
    //文章统计
    public function counts(): HasOne
    {
        return $this->hasOne(ArticlesCount::class, 'id');
    }
    //文章下的所有附件
    public function attachments(): HasMany
    {
        return $this->hasMany(ArticlesAttachment::class, 'article_id');
    }
}
