<?php

namespace App\Models\User;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/User/UserMessage.php
 * Created Time: 2025-03-07 09:24:32
 * Last Edit Time: 2025-03-07 09:34:03
 * Description: 用户消息模型
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMessage extends Model
{
    use SoftDeletes;
    protected $table = 'users_messages';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'read_at',
        'status',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
