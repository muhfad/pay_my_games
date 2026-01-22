<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay My Games</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<nav class="bg-indigo-600 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="/" class="font-bold text-xl text-white hover:text-indigo-200 transition">
                Pay My Games
            </a>

            <!-- Menu -->
            <div class="flex items-center space-x-4">
                <a href="/" class="text-white hover:text-indigo-200 transition">
                    Home
                </a>

                @auth
                    <a href="/my-orders" class="text-white hover:text-indigo-200 transition">
                        My Orders
                    </a>

                    <!-- Tombol Admin (hanya muncul jika role = admin) -->
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/orders" 
                           class="bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg 
                                  hover:bg-yellow-400 transition font-semibold">
                            Admin
                        </a>
                    @endif

                    <!-- Nama User -->
                    <span class="text-white">
                        👤 {{ auth()->user()->name }}
                    </span>

                    <!-- Logout -->
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="text-white hover:text-red-300 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" 
                       class="bg-white text-indigo-600 px-4 py-2 rounded-lg 
                              hover:bg-indigo-50 transition font-semibold">
                        Login
                    </a>
                    <a href="/register" 
                       class="border-2 border-white text-white px-4 py-2 rounded-lg 
                              hover:bg-white hover:text-indigo-600 transition font-semibold">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="container mx-auto p-6">
    @yield('content')
</div>

</body>
</html>