<?php

namespace App\Models\Article;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Article/ArticlesCount.php
 * Created Time: 2025-03-07 12:39:16
 * Last Edit Time: 2025-03-07 13:04:59
 * Description: 文章统计模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticlesCount extends Model
{
    protected $table = 'articles_counts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'daily_views',
        'weekly_views',
        'monthly_views',
        'all_views',
        'daily_comments',
        'weekly_comments',
        'monthly_comments',
        'all_comments',
        'daily_likes',
        'weekly_likes',
        'monthly_likes',
        'all_likes',
        'daily_dislikes',
        'weekly_dislikes',
        'monthly_dislikes',
        'all_dislikes',
        'daily_collections',
        'weekly_collections',
        'monthly_collections',
        'all_collections',
    ];
    //文章
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'id');
    }
}
