@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">إضافة تصنيف</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>اسم التصنيف</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">حفظ</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
