<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{

public function store(Request $request, Post $post)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $post->comments()->create([
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);

    return redirect()->route('posts.show', $post)->with('success', 'تم إضافة التعليق.');
}
public function destroy(Post $post, Comment $comment)
{
    if ($comment->user_id !== auth()->id()) {
        return redirect()->route('posts.show', $post)->with('error', 'لا يمكنك حذف هذا التعليق.');
    }

    $comment->delete();

    return redirect()->route('posts.show', $post)->with('success', 'تم حذف التعليق بنجاح.');
}}