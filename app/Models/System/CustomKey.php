<?php

namespace App\Models\System;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/System/CustomKey.php
 * Created Time: 2025-03-07 12:17:58
 * Last Edit Time: 2025-03-07 13:45:03
 * Description: 自定义键值对模型
 */

use Illuminate\Database\Eloquent\Model;

class CustomKey extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['key', 'note', 'value', 'field_type', 'group', 'permissions'];
    protected $casts = ['value' => 'array'];
}
