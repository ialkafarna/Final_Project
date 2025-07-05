<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories']);
        Category::create($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|unique:categories,name,' . $category->id]);
        $category->update($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'تم الحذف بنجاح');
    }
    public function construct()
{
    $this->middleware(function ($request, $next) {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك');
        }
        return $next($request);
    });
}

}
