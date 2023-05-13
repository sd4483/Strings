@extends('layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="w-full md:w-3/4 mx-auto">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-base font-bold text-gray-700 mb-2">Blog Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="featured_image" class="block text-base font-bold text-gray-700 mb-2">Featured Image</label>
                    <input type="file" id="image" name="image" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="content" class="block text-base font-bold text-gray-700 mb-2">Blog Content</label>
                    <textarea id="content" name="content" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    <script>
                        tinymce.init({
                          selector: '#content',
                          height: 400, // Specify the desired height for the editor
                          plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount', // Add desired plugins
                          toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | code | link image media', // Customize the toolbar with desired options
                          menubar: 'file edit view insert format tools table help', // Customize the menubar with desired options
                            // Optionally, link a custom CSS file for further styling
                        });
                    </script>                      
                </div>

                <div>
                    <label for="categories" class="block text-base font-bold text-gray-700 mb-2">Categories</label>
                    <input type="text" id="categories" name="categories" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter categories separated by commas">
                </div>                

                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Publish</button>
            </form>
        </div>

        @if(isset($blog) && !$blog->published)
            <a href="{{ route('welcome') }}" class="px-3 py-2 bg-red-600 text-white rounded-md flex items-center space-x-2">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m5-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <span>Delete Draft</span>
            </a>
        @endif

    </div>

</x-app-layout>    
@endsection
