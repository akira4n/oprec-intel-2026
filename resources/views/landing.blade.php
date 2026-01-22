<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oprec INTEL 2026</title>
    @vite(['resources/js/app.jsx'])
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <h1 class="text-4xl font-bold text-blue-600 mb-4">Open Recruitment INTEL 2026</h1>

        <div class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-800 text-white rounded">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Daftar Sekarang</a>
                @endauth
            @endif
        </div>
    </div>
</body>

</html>
