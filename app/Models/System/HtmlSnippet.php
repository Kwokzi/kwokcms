<?php

namespace App\Models\System;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/System/HtmlSnippet.php
 * Created Time: 2025-03-07 12:29:12
 * Last Edit Time: 2025-03-07 12:29:34
 * Description: HTML片段模型
 */

use Illuminate\Database\Eloquent\Model;

class HtmlSnippet extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['key', 'value', 'description', 'type', 'status'];
}
