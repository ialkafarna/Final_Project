<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // عرض كل التدوينات
   public function index()
{
    $posts = Post::with('user', 'category')->latest()->paginate(10);
    $categories = \App\Models\Category::all(); // أضف هذا السطر

}

    // عرض صفحة إنشاء تدوينة جديدة
    public function create()
    {
      $categories = \App\Models\Category::all();  // جلب جميع الفئات
    return view('posts.create', compact('categories'));
    }

    // حفظ تدوينة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'        => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

     
    $request->user()->posts()->create($request->only('title', 'content', 'category_id'));

    return redirect()->route('posts.index')->with('success', 'تم إضافة التدوينة!');
    }

    // عرض تدوينة واحدة
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // عرض صفحة تعديل التدوينة
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // حفظ التحديثات على التدوينة
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($request->only('title', 'body', 'category_id'));

        return redirect()->route('posts.index')->with('success', 'تم التحديث!');
    }

    // حذف التدوينة
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'تم الحذف!');
    }
}
