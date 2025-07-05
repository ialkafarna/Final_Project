@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تعديل التدوينة</h1>

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title">العنوان:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content">المحتوى:</label>
            <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id">الفئة:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- اختر فئة --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $post->category_id) == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tags">التاجات:</label>
            <select name="tags[]" id="tags" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @if(collect(old('tags', $post->tags->pluck('id')->toArray()))->contains($tag->id)) selected @endif
                    >
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">يمكنك اختيار أكثر من تاج بالضغط مع Ctrl أو Cmd</small>
        </div>

        <button type="submit" class="btn btn-success">تحديث التدوينة</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
