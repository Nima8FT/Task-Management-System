<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <title>Task Management System</title>
    @fluxAppearance
</head>

<body dir="rtl">
    <div class="container mx-auto p-4">
        {{ $slot }}
    </div>
    @fluxScripts
</body>

</html>