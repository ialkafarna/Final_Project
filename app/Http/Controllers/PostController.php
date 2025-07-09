<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag; // استدعاء موديل التاجات
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with(['category', 'tags', 'user'])->latest()->paginate(10);
        return view('posts.index', compact('posts'));
         // تحميل joinedPosts للمستخدم المسجل فقط لتجنب null
    if (auth()->check()) {
        auth()->user()->load('joinedPosts');
    }

    return view('posts.index', compact('posts'));
    }

    public function create() {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        $tags = Tag::all(); // جلب جميع التاجات
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request) {
        $this->authorize('create', Post::class);

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        $post = $request->user()->posts()->create($request->only('title', 'content', 'category_id'));

        // ربط التاجات مع المقالة
        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('posts.index')->with('success', 'تمت إضافة التدوينة!');
    }

public function show(Post $post) {
    $post->load(['category', 'tags', 'user', 'comments.user']); // حمل التعليقات مع بيانات المستخدم لكل تعليق
    return view('posts.show', compact('post'));
}


    public function edit(Post $post) {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        $post->load('tags'); // لتحميل التاجات الحالية
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post) {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        $post->update($request->only('title', 'content', 'category_id'));

        // تحديث التاجات
        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        } else {
            // إذا لم يتم إرسال تاجات، نفك الربط
            $post->tags()->detach();
        }

        return redirect()->route('posts.index')->with('success', 'تم التحديث!');
    }

    public function destroy(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'تم الحذف!');
    }
       public function join(Post $post)
    {
        auth()->user()->joinedPosts()->syncWithoutDetaching([$post->id]);

        return redirect()->back()->with('success', 'تم الانضمام إلى المقالة!');
    }
}
