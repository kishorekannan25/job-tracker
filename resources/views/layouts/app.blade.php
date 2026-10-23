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

                <div class="flex items-center gap-6">
                    <a href="{{ route('applications.index') }}" class="font-bold">Job Tracker</a>

                    <a href="{{ route('applications.index') }}"
                        class="text-sm {{ request()->routeIs('applications.*') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                            Applications
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>

                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 hover:underline">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    @yield('content')
</body>
</html>