@extends('layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Number of blogs and comments -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Your Statistics</h3>
                            <p>Blogs published: {{ Auth::user()->blogs()->count() }}</p>
                            <p>Comments made: {{ Auth::user()->comments()->count() }}</p>
                        </div>

                        <!-- List of blogs and comments -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Your Blogs</h3>
                            <ul>
                                @foreach(Auth::user()->blogs as $blog)
                                    <li>{{ $blog->title }}</li>
                                @endforeach
                            </ul>

                            <h3 class="text-lg font-semibold mb-2 mt-4">Your Comments</h3>
                            <ul>
                                @foreach(Auth::user()->comments as $comment)
                                    <li>{{ $comment->body }} (Likes: {{ $comment->likes }} , Dislikes: {{ $comment->dislikes }})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
