@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-primary fw-bold">📂 قائمة التصنيفات</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- زر إضافة تصنيف جديد --}}
    @can('create', App\Models\Category::class)
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">➕ إضافة تصنيف جديد</a>
    @endcan

    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th style="width: 70px;">الرقم</th>
                    <th>الاسم</th>
                    <th style="width: 180px;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $index }}</td>
                        <td class="fw-bold text-primary">{{ $category->name }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="إجراءات التصنيف">
                                @can('update', $category)
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary">✏️ تعديل</a>
                                @endcan
                                @can('delete', $category)
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">🗑️ حذف</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted">لا توجد تصنيفات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- الباجينايشن --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>
@endsection
