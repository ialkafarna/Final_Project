@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-extrabold text-indigo-700">📝 لوحة التحكم - المقالات</h2>
        @can('create', App\Models\Post::class)
            <a href="{{ route('posts.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-lg px-6 py-3 rounded shadow-md">
                ➕ إضافة تدوينة
            </a>
        @endcan
    </div>

    {{-- مربع البحث --}}
    <form method="GET" class="mb-6 flex gap-4">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="🔍 ابحث عن عنوان..."
            class="flex-1 px-5 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md text-lg font-semibold">
            بحث
        </button>
    </form>

    {{-- جدول المقالات --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full text-right text-gray-700">
            <thead class="bg-indigo-100 text-indigo-900 font-semibold text-lg">
                <tr>
                    <th class="px-6 py-4 w-16 text-center">#</th>
                    <th class="px-6 py-4">العنوان</th>
                    <th class="px-6 py-4 w-64">المحتوى</th>
                    <th class="px-6 py-4 w-40">الفئة</th>
                    <th class="px-6 py-4 w-40">الكاتب</th>
                    <th class="px-6 py-4 w-48">التاجات</th>
                    <th class="px-6 py-4 w-48 text-center">انضمام</th> {{-- عمود جديد --}}
                    <th class="px-6 py-4 w-48 text-center">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($posts as $index => $post)
                    <tr class="hover:bg-indigo-50">
                        <td class="px-6 py-4 text-center font-semibold">{{ $posts->firstItem() + $index }}</td>

                        <td class="px-6 py-4 font-bold text-indigo-700">
                            <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                                {{ $post->title }}
                            </a>
                        </td>

                        <td class="px-6 py-4 truncate max-w-xs">
                            {{ \Illuminate\Support\Str::limit($post->content, 60) }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-block bg-indigo-200 text-indigo-900 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $post->category->name ?? 'غير مصنفة' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-green-700 font-medium">
                            {{ $post->user->name ?? 'غير معروف' }}
                        </td>

                        <td class="px-6 py-4 space-x-1 space-x-reverse">
                            @forelse ($post->tags as $tag)
                                <span class="inline-block bg-gray-300 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $tag->name }}
                                </span>
                            @empty
                                <span class="text-gray-400 italic text-sm">بدون</span>
                            @endforelse
                        </td>

                        {{-- عمود الانضمام --}}
                        <td class="px-6 py-4 text-center">
                            @auth
                                @if(auth()->user()->role !== 'admin')
                                    @if(!auth()->user()->joinedPosts->contains($post->id))
                                    <form action="{{ route('posts.join', $post->id) }}" method="POST" class="inline-block">
    @csrf
    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
        📥 انضم إلى المقالة
    </button>
</form>

                                    @else
                                        <span class="text-green-600 font-semibold">✅ تم الانضمام</span>
                                    @endif
                                @endif
                            @endauth
                        </td>

                        <td class="px-6 py-4 text-center space-x-2 space-x-reverse">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="inline-block bg-blue-200 hover:bg-blue-300 text-black px-4 py-2 rounded-md text-sm font-semibold">
                                     ✏️ تعديل
                                </a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-semibold">
                                        🗑️ حذف
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-400 italic text-lg">
                            لا توجد تدوينات حالياً.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- الباجينايشن --}}
    <div class="mt-8 flex justify-center">
        {{ $posts->links() }}
    </div>

</div>
@endsection
