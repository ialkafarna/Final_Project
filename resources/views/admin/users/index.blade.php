@extends('layouts.app')

@section('content')
<div class="container">
    <h2>إدارة المستخدمين</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الإيميل</th>
                <th>الدور</th>
                <th>تعديل</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="form-select" onchange="this.form.submit()">
                            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>مشرف</option>
                            <option value="author" {{ $user->role=='author'?'selected':'' }}>كاتب</option>
                            <option value="reader" {{ $user->role=='reader'?'selected':'' }}>قارئ</option>
                        </select>
                    </form>
                </td>
                <td>
                    @if($user->role != 'admin')
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('متأكد؟')">حذف</button>
                    </form>
                    @else
                    <span>لا يمكن حذف مشرف</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
