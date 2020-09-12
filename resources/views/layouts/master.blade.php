<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'New Page') | DropShop</title>

    @section('styles')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @show
</head>
<body>

    <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
        @yield('content')
    </div>

    @section('scripts')
        <script>
            window.data = @json(get_defined_vars()['__data']);
        </script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
        <script src="{{ mix('js/app.js') }}"></script>
    @show
</body>
</html>
