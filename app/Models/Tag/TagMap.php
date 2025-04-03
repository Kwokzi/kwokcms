<?php

namespace App\Models\Tag;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Tag/TagMap.php
 * Created Time: 2025-03-07 12:30:37
 * Last Edit Time: 2025-03-27 10:30:59
 * Description: 标签映射模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TagMap extends Model
{
    protected $fillable = ['tag_id', 'taggable_id', 'taggable_type'];

    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }
}
