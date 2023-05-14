@extends('layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto py-2 flex flex-wrap md:flex-nowrap">
        <!-- Blog List -->
        <div class="w-full md:w-3/4 md:pr-8 bg-gray-200 mr-8 p-4 rounded-md">
            <h1 class="text-xl font-bold mb-4 underline decoration-dotted">All blogs</h1>

            @if ($blogs->count() > 0)
                @foreach ($blogs as $blog)
                    <div class="mb-4 flex flex-wrap md:flex-nowrap pb-4 border-solid border-b-2 border-gray-300">
                        <img src="/images/{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full md:w-1/3 h-auto md:h-40 object-cover mb-4 md:mb-0 md:mr-6">
                        <div class="w-full md:w-2/3">
                            <p class="text-sm text-gray-500 mb-2">
                                @foreach($blog->categories as $category)
                                    <a href="{{ route('categories.show', $category) }}" class="hover:underline uppercase"> {{ $category->name }}</a>{{ !$loop->last ? ',' : '' }}
                                @endforeach
                                | {{ $blog->created_at->format('M d, Y') }}
                            </p>
                            <h2 class="text-2xl font-bold hover:underline mb-2"><a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a></h2>
                        </div>
                    </div>
                @endforeach
                <!-- Render the pagination links -->
                {{ $blogs->links() }}
            @else
                <p>No blogs found.</p>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="w-full md:w-1/4 mt-8 md:mt-0">
            <div class="bg-blue-100 p-4 rounded-md">
                <h2 class="text-lg font-bold text-gray-900 mb-4 underline decoration-dotted">Top categories</h2>
                <ul>
                    @foreach($topCategories as $category)
                        <li class="mb-4"><a href="{{ route('categories.show', $category) }}" class="text-gray-900">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

