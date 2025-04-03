<?php

namespace App\Models\User;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/User/UserSession.php
 * Created Time: 2025-03-07 09:24:32
 * Last Edit Time: 2025-03-07 09:33:53
 * Description: 用户会话表模型
 */

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $table = 'users_sessions';
    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
