<?php

namespace App\Models\User;

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /app/Models/User/User.php
 * Created Time: 2025-03-04 23:48:56
 * Last Edit Time: 2025-03-07 10:06:45
 * Description: 用户模型
 */

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'group_id',
        'username',
        'password',
        'nickname',
        'sex',
        'mobile',
        'email',
        'signature',
        'register_ip',
        'last_login_ip',
        'experience',
        'follow_count',
        'fans_count',
        'liked_count',
        'post_count',
        'comment_count',
        'avatar_url',
        'avatar_at',
        'identity',
        'realname',
        'status',
        'last_post_at',
        'last_comment_at',
        'login_at',
    ];
    //需要隐藏的属性
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'password_updated_at',
        'identity', // 身份证信息敏感，隐藏
        'realname',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'avatar_at' => 'datetime',
            'last_post_at' => 'datetime',
            'last_comment_at' => 'datetime',
            'login_at' => 'datetime',
            'status' => 'integer',
            'email_verified_at' => 'datetime',
            'password_updated_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * 判断是否为管理员
     */
    public function isAdmin(): bool
    {
        return $this->group_id === 1; //group_id=1 代表管理员
    }

    /**
     * 获取用户组
     */
    public function group()
    {
        return $this->belongsTo(UserGroup::class, 'group_id');
    }
    /**
     * 获取用户的所有关注
     */
    public function followers()
    {
        return $this->hasMany(UserFollower::class, 'following_id');
    }
    /**
     * 获取用户的所有粉丝
     */
    public function following()
    {
        return $this->hasMany(UserFollower::class, 'follower_id');
    }
    /**
     * 获取用户的所有私信
     */
    public function messages()
    {
        return $this->hasMany(UserMessage::class, 'receiver_id');
    }

    /**
     * 头像 URL 访问器
     */
    public function getAvatarUrlAttribute($value): string
    {
        return $value ? asset($value) : asset('default-avatar.png');
    }

    /**
     * 性别解析
     */
    public function getSexTextAttribute(): string
    {
        return match ($this->sex) {
            0 => '女',
            1 => '男',
            default => '未知',
        };
    }
    /**
     * 状态解析
     */
    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            0 => '正常',
            1 => '禁用',
            2 => '审核中',
            3 => '审核拒绝',
            4 => '审核忽略',
            default => '未知',
        };
    }
}
