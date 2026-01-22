<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pay My Games</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<nav class="bg-indigo-700 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-8">
                <a href="/admin/orders" class="font-bold text-xl text-white">
                    Admin Panel
                </a>
                <div class="flex items-center space-x-4">
                    <a href="/admin/orders" class="text-white hover:text-yellow-300 transition">
                        Orders
                    </a>
                    <a href="/admin/games" class="text-white hover:text-yellow-300 transition">
                        Games
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <a href="/" class="text-white hover:text-yellow-300 transition">
                    Kembali ke Site
                </a>
                <span class="text-white">
                    {{ auth()->user()->name }}
                </span>
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:text-red-300 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container mx-auto p-6">
    @yield('content')
</div>

</body>
</html>