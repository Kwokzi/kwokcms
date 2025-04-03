<?php

namespace App\Models\Article;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Article/ArticlesCategory.php
 * Created Time: 2025-03-07 12:35:37
 * Last Edit Time: 2025-03-07 13:03:27
 * Description: 文章分类模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticlesCategory extends Model
{

    protected $table = 'articles_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'up_id',
        'name',
        'slug',
        'icon',
        'description',
        'title',
        'order',
        'tpl',
        'articles_tpl',
        'perpage',
        'status',
    ];
    //上级分类
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ArticlesCategory::class, 'up_id');
    }
    //下级分类
    public function children(): HasMany
    {
        return $this->hasMany(ArticlesCategory::class, 'up_id');
    }
    //分类下的所有文章
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'catid');
    }
}
