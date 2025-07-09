@extends('layouts.app')

@section('content')
<div class="py-10 text-center">
    <h2 class="text-3xl font-bold text-indigo-700 mb-2">📝 منصة إدارة التدوين</h2>
    <p class="text-gray-600 mb-6">أنشئ، راقب، وقم بإدارة المقالات والمستخدمين والتعليقات بكل سهولة.</p>

    <div class="flex justify-center gap-4 mb-10 flex-wrap">
        <a href="{{ route('posts.index') }}" class="border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white font-semibold px-6 py-2 rounded shadow transition">
            📚 عرض المقالات
        </a>
        @can('manage-users')
        <a href="{{ route('admin.users.index') }}" class="border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white font-semibold px-6 py-2 rounded shadow transition">
            👥 إدارة المستخدمين
        </a>
        @endcan
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-indigo-100 p-6 rounded-xl shadow hover:shadow-md transition">
            <h4 class="text-xl font-bold text-indigo-700 mb-2">📄 عدد المقالات</h4>
            <p class="text-4xl font-extrabold text-gray-800">{{ $postsCount }}</p>
        </div>

        <div class="bg-green-100 p-6 rounded-xl shadow hover:shadow-md transition">
            <h4 class="text-xl font-bold text-green-700 mb-2">👤 عدد المستخدمين</h4>
            <p class="text-4xl font-extrabold text-gray-800">{{ $usersCount }}</p>
        </div>

        <div class="bg-yellow-100 p-6 rounded-xl shadow hover:shadow-md transition">
            <h4 class="text-xl font-bold text-yellow-700 mb-2">💬 عدد التعليقات</h4>
            <p class="text-4xl font-extrabold text-gray-800">{{ $commentsCount }}</p>
        </div>
    </div>
</div>
@endsection
