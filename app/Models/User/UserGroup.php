<?php

namespace App\Models\User;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/User/UserGroup.php
 * Created Time: 2025-03-07 09:24:32
 * Last Edit Time: 2025-03-07 09:32:00
 * Description: 用户组模型
 */

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'users_groups';
    protected $fillable = [
        'name',
        'type',
        'color',
        'icon',
        'permissions',
        'price',
        'experience',
        'description',
        'status',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * 获取属于该用户组的用户
     */
    public function users()
    {
        return $this->hasMany(User::class, 'group_id');
    }
}
