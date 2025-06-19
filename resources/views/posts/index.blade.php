@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">جميع التدوينات</h1>

    {{-- عرض رسالة النجاح --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- زر إضافة تدوينة جديدة --}}
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">إضافة تدوينة جديدة</a>

    <div class="card">
        <div class="card-body">
            @forelse ($posts as $post)
                <div class="mb-4">
                    <h4>
                        <a href="{{ route('posts.show', $post) }}">
                            {{ $post->title }}
                        </a>
                    </h4>

                    <p>{{ Str::limit($post->content, 150) }}</p>

                    <p><strong>الفئة:</strong> {{ $post->category->name ?? 'غير مصنفة' }}</p>

                    {{-- عرض أزرار التعديل والحذف فقط لمن يملك صلاحية التعديل --}}
                    @can('update', $post)
                        <div class="mt-2">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">تعديل</a>

                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline-block" onsubmit="return confirm('هل أنت متأكد؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </div>
                    @endcan
                </div>
                <hr>
            @empty
                <p>لا توجد تدوينات بعد.</p>
            @endforelse

            {{-- أزرار التنقل بين الصفحات --}}
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
