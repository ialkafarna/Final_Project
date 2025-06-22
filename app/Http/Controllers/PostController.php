<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create() {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request) {
        $this->authorize('create', Post::class);

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $request->user()->posts()->create($request->only('title', 'content', 'category_id'));

        return redirect()->route('posts.index')->with('success', 'تمت إضافة التدوينة!');
    }

    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post) {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post) {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($request->only('title', 'content', 'category_id'));

        return redirect()->route('posts.index')->with('success', 'تم التحديث!');
    }

    public function destroy(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'تم الحذف!');
    }
}
