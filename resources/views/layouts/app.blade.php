<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    @section('styles')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @show
</head>
<body class="bg-gray-100">
    @include('layouts.products')
    @section('scripts')
        <script src="{{ mix('js/app.js') }}"></script>
    @show
</body>
</html>
