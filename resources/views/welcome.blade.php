<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(!env('APP_ENV', 'testing'))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <h1 class="text-red-900">Nima</h1>
</body>

</html>