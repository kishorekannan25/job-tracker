<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Job Tracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @yield('content')
</body>
</html>