@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل التدوينة</h1>

    {{-- عرض الأخطاء --}}
    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- نموذج التعديل --}}
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title">العنوان:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="content">المحتوى:</label>
            <textarea name="content" id="content" rows="6" class="form-control">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id">الفئة:</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">-- اختر فئة --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">تحديث التدوينة</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
