<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
             'category_id' => $request->category_id,
            'user_id' => $request->user()->id,
        ]);

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        $post->load('user');
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        // Authorization: only owner or admin can update
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($request->only('title', 'content'));

        return new PostResource($post);
    }

public function destroy(Post $post)
{
    $this->authorize('delete', $post);

    $post->delete();

    return response()->json([
        'message' => 'تم حذف المنشور بنجاح'
    ], 200);
}

}
