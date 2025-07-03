@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">👋 أهلا بك في نظام التدوين</h1>

    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="card shadow rounded p-3">
                <h4>عدد المقالات</h4>
                <p class="display-4">{{ $postsCount }}</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow rounded p-3">
                <h4>عدد المستخدمين</h4>
                <p class="display-4">{{ $usersCount }}</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow rounded p-3">
                <h4>عدد التعليقات</h4>
                <p class="display-4">{{ $commentsCount }}</p>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('posts.index') }}" class="btn btn-primary">عرض المقالات</a>
        @can('manage-users')
            <a href="{{ route('admin.users.index') }}" class="btn btn-success">إدارة المستخدمين</a>
        @endcan
    </div>
</div>
@endsection
