<?php

namespace App\Models\Article;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Article/ArticlesComment.php
 * Created Time: 2025-03-07 12:37:16
 * Last Edit Time: 2025-03-07 13:04:39
 * Description: 文章评论模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User\User;

class ArticlesComment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'article_id',
        'reply_comment_id',
        'parent_id',
        'reply_user_id',
        'user_id',
        'username',
        'content',
        'agree_count',
        'diss_count',
        'is_anonymous',
        'status',
        'ip_address',
    ];
    //文章
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
    //回复评论
    public function replyComment(): BelongsTo
    {
        return $this->belongsTo(ArticlesComment::class, 'reply_comment_id');
    }
    //父级评论
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ArticlesComment::class, 'parent_id');
    }
    //子级评论
    public function replies(): HasMany
    {
        return $this->hasMany(ArticlesComment::class, 'parent_id');
    }
    //用户
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    //回复用户
    public function replyUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reply_user_id');
    }
}
