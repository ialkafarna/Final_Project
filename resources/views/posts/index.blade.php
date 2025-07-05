@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-primary fw-bold">📝 لوحة التحكم - المقالات</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- روابط سريعة --}}
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark me-2">🏠 لوحة التحكم</a>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary me-2">📂 التصنيفات</a>
        </div>
        @can('create', App\Models\Post::class)
            <a href="{{ route('posts.create') }}" class="btn btn-success">➕ إضافة تدوينة</a>
        @endcan
    </div>

    {{-- مربع البحث --}}
    <form method="GET" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control me-2 shadow-sm" placeholder="🔍 ابحث عن عنوان..." value="{{ request('search') }}">
        <button class="btn btn-primary">بحث</button>
    </form>

    {{-- جدول المقالات --}}
    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>العنوان</th>
                    <th>المحتوى</th>
                    <th>الفئة</th>
                    <th>الكاتب</th>
                    <th>التاجات</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td class="fw-bold text-primary">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($post->content, 50) }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $post->category->name ?? 'غير مصنفة' }}</span>
                        </td>
                        <td>
                            <span class="text-success">{{ $post->user->name ?? 'غير معروف' }}</span>
                        </td>
                        <td>
                            @forelse($post->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @empty
                                <span class="text-muted">بدون</span>
                            @endforelse
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-primary">✏️ تعديل</a>
                                @endcan
                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ حذف</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">لا توجد تدوينات حاليًا.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- الباجينايشن --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
