<?php

namespace App\Models\User;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/User/UserNotification.php
 * Created Time: 2025-03-07 09:24:32
 * Last Edit Time: 2025-03-07 09:32:26
 * Description: 用户通知模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNotification extends Model
{
    use SoftDeletes;
    protected $table = 'users_notifications';
    protected $fillable = [
        'type',
        'sender',
        'send_user_id',
        'notification_level',
        'user_id',
        'title',
        'message',
        'redirect_url',
        'read_at',
    ];
    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function senderUser()
    {
        return $this->belongsTo(User::class, 'send_user_id');
    }
}
