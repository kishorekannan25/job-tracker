<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Job Tracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @auth
        <nav class="bg-white shadow">
            <div class="max-w-3xl mx-auto px-6 py-3 flex justify-between items-center">
                <a href="{{ route('applications.index') }}" class="font-bold">Job Tracker</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:underline">
                        Log out ({{ auth()->user()->name }})
                    </button>
                </form>
            </div>
        </nav>
    @endauth

    @yield('content')
</body>
</html>