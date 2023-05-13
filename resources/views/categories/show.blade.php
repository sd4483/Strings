@extends('layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto px-6 py-8 bg-gray-200 rounded-md">
        <h1 class="text-xl font-bold mb-4 underline decoration-dotted">Blogs in {{ $category->name }}</h1>

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
            @else
                <p>No blogs found.</p>
        @endif

        
    </div>
</x-app-layout>
@endsection


