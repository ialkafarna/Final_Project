@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    {{-- بيانات التدوينة --}}
    <p><strong>الفئة:</strong> {{ $post->category->name ?? 'غير مصنفة' }}</p>
    <p><strong>بواسطة:</strong> {{ $post->user->name }}</p>

    <div class="mb-4">
        {!! nl2br(e($post->content)) !!}
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mb-4">رجوع للصفحة الرئيسية</a>

    {{-- عرض التعليقات --}}
    <h4>التعليقات</h4>
    @forelse ($post->comments as $comment)
        <div class="border p-3 mb-3 rounded">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->body }}</p>
        </div>
    @empty
        <p class="text-muted">لا توجد تعليقات حتى الآن.</p>
    @endforelse

    {{-- نموذج إضافة تعليق --}}
    @auth
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group mb-2">
                <label for="body">أضف تعليق:</label>
                <textarea name="body" id="body" rows="3" class="form-control" required>{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">نشر التعليق</button>
        </form>
    @else
        <p class="text-muted mt-4">يرجى <a href="{{ route('login') }}">تسجيل الدخول</a> لإضافة تعليق.</p>
    @endauth
</div>
@endsection
