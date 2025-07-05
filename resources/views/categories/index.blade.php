@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">قائمة التصنيفات</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- زر إضافة تصنيف جديد للأدمن والكاتب فقط --}}
    @if(in_array(auth()->user()->role, ['admin', 'author']))
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">إضافة تصنيف جديد</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الرقم</th>
                <th>الاسم</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        {{-- أزرار التعديل والحذف تظهر فقط للأدمن والكاتب --}}
                        @if(in_array(auth()->user()->role, ['admin', 'author']))
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">تعديل</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('متأكد من الحذف؟')">حذف</button>
                            </form>
                        @else
                            <span class="text-muted">غير مسموح</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">لا توجد تصنيفات</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
