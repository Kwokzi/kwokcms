<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/Tag/Tag.php
 * Created Time: 2025-03-07 12:30:00
 * Last Edit Time: 2025-03-07 12:30:16
 * Description: 标签模型
 */

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tagname', 'slug', 'description', 'title', 'status'];
}
