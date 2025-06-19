<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'approved',
    ];

    // المقال ينتمي لكاتب (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // المقال ينتمي لتصنيف (Category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // المقال يحتوي على عدة تعليقات
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // علاقة many-to-many مع الوسوم (Tags)
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}