<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
    $postsCount = \App\Models\Post::count();
    $usersCount = \App\Models\User::count();
    $commentsCount = \App\Models\Comment::count();
    $posts = Post::with('user', 'category')->latest()->paginate(10);

    return view('home', compact('posts', 'postsCount', 'usersCount', 'commentsCount'));
}

    }
