@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">جميع التدوينات</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                    <p>{{ Str::limit($post->body, 150) }}</p>
<select name="category_id" id="category_id" style="width: 100%;">
    <option value="">-- اختر فئة --</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>

</div>



                    @can('update', $post)
                        <div class="mt-2">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">تعديل</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                            </form>
                        </div>
                    @endcan
                </div>
                <hr>
            @empty
                <p>لا توجد تدوينات بعد.</p>
            @endforelse

            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
