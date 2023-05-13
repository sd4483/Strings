@extends('layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto py-8 flex">
        <div class="w-3/4 pr-4">
            <h1 class="text-4xl font-bold mb-4">{{ $blog->title }}</h1>
            <p class="text-lg mb-2 text-gray-700"><strong>By</strong> {{ $blog->user->name }}</p>

            <p class="mb-4 text-lg">
                <strong>Category:</strong> 
                @foreach($blog->categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="text-gray-700 underline">{{ $category->name }}</a>{{ !$loop->last ? ',' : '' }}
                @endforeach
            </p>
            
            @if ($blog->featured_image)
                <img src="/images/{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="mb-4">
            @endif

            <div class="blog-content prose prose-lg w-full max-w-none mb-12 mt-12">
                {!! $blog->content !!}
            </div>

            <!-- Comments -->
            <div class="comments-content">
                @include('comments.show', ['blog' => $blog])
            </div>
        </div>
        <div class="w-1/4 pl-4">
            <div class="bg-blue-100 p-4 rounded-md mb-4">
                <h2 class="text-lg font-bold text-gray-900 mb-4 underline decoration-dotted">Latest Blogs </h2>
                <ul>
                    @foreach($latestBlogs as $latestBlog)
                        <li class="mb-4"><a href="{{ route('blogs.show', $latestBlog->slug) }}" class="text-gray-900">{{ $latestBlog->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-blue-100 p-4 rounded-md">
                <h2 class="text-lg font-bold text-gray-900 mb-4 underline decoration-dotted">Top Categories</h2>
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
