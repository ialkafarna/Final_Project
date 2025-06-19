@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إضافة تدوينة جديدة</h1>

    {{-- عرض الأخطاء --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- نموذج إنشاء تدوينة --}}
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="title">عنوان التدوينة:</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}" style="width: 100%;">
        </div>

      <div style="margin-bottom: 10px;">
    <label for="content">المحتوى:</label><br>
    <textarea name="content" id="content" rows="6" style="width: 100%;">{{ old('content') }}</textarea>
</div>


        <div style="margin-bottom: 10px;">
            <label for="category_id">الفئة:</label><br>
            <select name="category_id" id="category_id" style="width: 100%;" required>
                <option value="">-- اختر فئة --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">نشر التدوينة</button>
        <a href="{{ route('posts.index') }}" style="margin-left: 10px;">رجوع</a>
    </form>
</div>
@endsection
