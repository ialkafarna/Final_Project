<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'body',
    ];

    // التعليق يعود لمقال (Post)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // التعليق يعود لمستخدم (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}