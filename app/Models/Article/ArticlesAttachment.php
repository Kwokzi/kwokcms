<?php

namespace App\Models\Article;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Article/ArticlesAttachment.php
 * Created Time: 2025-03-07 12:40:02
 * Last Edit Time: 2025-03-07 13:03:04
 * Description: 文章附件模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User\User;

class ArticlesAttachment extends Model
{
    protected $fillable = [
        'article_id',
        'uuid',
        'user_id',
        'description',
        'file_type',
        'file_size',
        'file_name',
        'is_image',
        'file_path',
        'is_remote',
        'mime_type',
        'storage_type',
        'ip_address',
    ];
    //文章
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
    //用户
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
