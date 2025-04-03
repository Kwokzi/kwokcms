<?php

namespace App\Models\User;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/User/PasswordResetToken.php
 * Created Time: 2025-03-07 09:24:32
 * Last Edit Time: 2025-03-07 09:33:29
 * Description: 用户密码重置令牌
 */

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'users_password_reset_tokens';
    protected $fillable = ['email', 'token', 'created_at'];
    public $timestamps = false;
}
