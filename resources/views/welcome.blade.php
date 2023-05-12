@extends('layout')

@section('content')
<x-guest-layout>
    <div class="container mx-auto">
        @foreach ($blogs as $blog)
            <div class="my-4 p-4 bg-white shadow">
                <h2 class="text-xl font-bold">{{ $blog->title }}</h2>
                <p>Published by: {{ $blog->user->name }}</p>
                <p>Categories:</p>
                <ul>
                    @foreach($blog->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-guest-layout>
@endsection
