@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">جميع التدوينات</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('create', App\Models\Post::class)
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">إضافة تدوينة جديدة</a>
    @endcan

    <div class="card">
        <div class="card-body">
            @forelse ($posts as $post)
                <div class="mb-4">
                    <h4><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>
                    <p>{{ Str::limit($post->content, 150) }}</p>
                    <p><strong>الفئة:</strong> {{ $post->category->name ?? 'غير مصنفة' }}</p>

                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">تعديل</a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    @endcan
                </div>
                <hr>
            @empty
                <p>لا توجد تدوينات بعد.</p>
            @endforelse

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
