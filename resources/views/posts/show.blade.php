@extends('layouts.app')

@section('content')
<div class="container">
    {{-- عرض رسالة نجاح أو خطأ --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- عنوان التدوينة --}}
    <h2>{{ $post->title }}</h2>

    {{-- تفاصيل إضافية --}}
    <p>
        <strong>الفئة:</strong> {{ $post->category->name ?? 'غير مصنفة' }}<br>
        <strong>الكاتب:</strong> {{ $post->user->name ?? 'غير معروف' }}<br>
        <strong>تاريخ النشر:</strong> {{ $post->created_at->format('Y-m-d') }}
    </p>

    {{-- المحتوى --}}
    <div class="mb-4">
        <p>{{ $post->content }}</p>
    </div>

    <hr>

    {{-- التعليقات --}}
    <h4>التعليقات:</h4>
    @forelse ($post->comments as $comment)
        <div class="border p-3 mb-3 rounded">
            <strong>{{ $comment->user->name ?? 'مستخدم' }}</strong>
            <p>{{ $comment->content }}</p>

       {{-- زر حذف التعليق (لصاحب التعليق فقط) --}}
@if (auth()->check() && auth()->id() === $comment->user_id)
    <form action="{{ route('comments.destroy', [$post, $comment]) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف التعليق؟')">حذف</button>
    </form>
@endif

        </div>
    @empty
        <p>لا توجد تعليقات بعد.</p>
    @endforelse

    {{-- إضافة تعليق جديد --}}
    @auth
        <hr>
        <h4>أضف تعليقًا:</h4>
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" rows="4" class="form-control" placeholder="اكتب تعليقك هنا..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">نشر التعليق</button>
        </form>
    @else
        <p class="mt-4">يرجى <a href="{{ route('login') }}">تسجيل الدخول</a> لإضافة تعليق.</p>
    @endauth

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">رجوع</a>
    </div>
</div>
@endsection
