<?php

namespace App\Models\System;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/System/FriendLink.php
 * Created Time: 2025-03-07 12:25:26
 * Last Edit Time: 2025-03-07 12:25:42
 * Description: 友情链接模型
 */

use Illuminate\Database\Eloquent\Model;

class FriendLink extends Model
{
    protected $fillable = ['name', 'url', 'logo', 'description', 'sort', 'status', 'remarks'];
}
