<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $usersCount = User::count();

        return view('dashboard', compact('postsCount', 'commentsCount', 'usersCount'));
    }
}
