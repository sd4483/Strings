<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{Strings}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

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
            <div>{Strings}</div>
            @if (Auth::check())
                <div class="text-center">{{ Auth::user()->name }}</div>
            @endif
            <div>
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="text-white no-underline">
                            Logout
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white no-underline">Login</a>
                    <a href="{{ route('register') }}" class="text-white no-underline ml-4">Register</a>
                @endif
            </div>
            
        </div>
    </nav>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
</body>
</html>
