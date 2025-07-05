@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">تعديل التصنيف</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>اسم التصنيف</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button class="btn btn-primary">تحديث</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
