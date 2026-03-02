<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'DIKLAT RS BALIMED DENPASAR') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-500 via-blue-500 to-purple-600 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-pink-300/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-cyan-300/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center px-4">
        {{ $slot }}
    </div>
</body>
</html>