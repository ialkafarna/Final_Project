@extends('layouts.app')
@php use App\Models\Post; @endphp
@section('content')
<div class="container">
    @can('create', App\Models\Post::class)
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="mb-4">إضافة تدوينة جديدة</h2>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title">العنوان:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content">المحتوى:</label>
                <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category_id">الفئة:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">-- اختر فئة --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">نشر</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    @endcan
</div>
@endsection
