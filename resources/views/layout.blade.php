<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{Strings}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/zuyxkt4uedoquqn38nf5xmhfvcpc8dn4noer8xqqt41lwnrb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="p-6 bg-black text-white">
        <div class="container mx-auto flex justify-between items-center">
            <div><a href="{{ route('welcome') }}" class="text-lg font-bold">{Strings}</div>
                @if (Auth::check())
                    <div class="text-center text-lg uppercase">{{ Auth::user()->name }}</div>
                        <div class="flex">
                            <a href="{{ route('profile.edit') }}" class="text-white no-underline">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-white no-underline ml-6">
                                    Logout
                                </a>
                            </form>
                        </div>
                @else
                <div class="flex">
                    <a href="{{ route('login') }}" class="text-white no-underline">Login</a>
                    <a href="{{ route('register') }}" class="text-white no-underline ml-6">Register</a>
                </div>
                @endif
            </div>         
        </div> 
    </nav>

    <!-- Write Something / Cancel Button -->
    <div class="container mx-auto flex justify-end mt-8">
        @auth
            @if (Route::currentRouteNamed('blogs.create'))
                <a href="{{ route('welcome') }}" class="px-3 py-2 rounded-md text-white bg-red-500 inline-flex items-center space-x-2">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12l-18 8 6-8-6-8 18 8z" />
                    </svg>
                    <span>Cancel</span>
                </a>
            @else
                <a href="{{ route('blogs.create') }}" class="px-3 py-2 rounded-md text-white bg-blue-700 inline-flex items-center space-x-2">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    <span>Write Something</span>
                </a>
            @endif
        @endauth
    </div>

  
    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
</body>
</html>
