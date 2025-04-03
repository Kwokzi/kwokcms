<?php

namespace App\Models\System;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/System/Setting.php
 * Created Time: 2025-03-07 12:31:26
 * Last Edit Time: 2025-03-09 11:31:12
 * Description: 系统设置模型
 */

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['key', 'value', 'note'];
}
