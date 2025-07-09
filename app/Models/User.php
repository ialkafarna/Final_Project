<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * الحقول اللي مسموح بالتعبئة الجماعية فيها (Mass Assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // أضفنا دور المستخدم
    ];

    /**
     * الحقول المخفية عند تحويل النموذج إلى JSON أو Arrays
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * الحقول اللي تتحول لأنواع بيانات معينة تلقائياً
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * علاقة الـUser مع المقالات (posts)
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * علاقة الـUser مع التعليقات (comments)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * دالة مساعدة للتحقق من دور المستخدم بسهولة
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAuthor()
    {
        return $this->role === 'author';
    }

    public function isReader()
    {
        return $this->role === 'reader';
    }
       public function joinedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_user', 'user_id', 'post_id')->withTimestamps();
    }
}
