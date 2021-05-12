<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use App\Models\Post;
use App\Models\Comment;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,EntrustUserWithPermissionsTrait;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function commets()
    {
        return $this->hasMany(Comment::class);
    }
}
