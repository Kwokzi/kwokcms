<?php

namespace App\Models\User;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/User/UserFollower.php
 * Created Time: 2025-03-07 09:24:33
 * Last Edit Time: 2025-03-07 09:33:18
 * Description: 用户关注模型
 */

use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{
    protected $table = 'users_followers';
    protected $fillable = [
        'follower_id',
        'following_id',
        'mutual',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
