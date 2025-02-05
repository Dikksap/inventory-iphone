<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Inventory iPhone - Admin Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }

        body {
            background: linear-gradient(to bottom, #3d68ff, #f8f9fa);
            background-size: 100% 100%;
            animation: gradient 10s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 font-family-karla">

    <div class="w-full max-w-sm md:max-w-md bg-white p-6 md:p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
            </svg>
        </div>

        <h1 class="text-2xl md:text-3xl font-semibold text-center text-gray-700 mb-6">Login Admin</h1>

        @if (session('message'))
        <div class="text-red-500 text-sm text-center mb-4">
            {{ session('message') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="text-red-500 text-sm mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf
            <div class="relative">
                <input autocomplete="off" id="email" name="email" type="text" value="{{ old('email') }}" required
                       class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 text-sm md:text-base px-2"/>
                <label for="email" class="absolute left-2 -top-3.5 text-gray-600 text-xs transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-xs">
                    Email Address
                </label>
            </div>

            <div class="relative">
                <input autocomplete="off" id="password" name="password" type="password" required
                       class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 text-sm md:text-base px-2"/>
                <label for="password" class="absolute left-2 -top-3.5 text-gray-600 text-xs transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-xs">
                    Password
                </label>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm md:text-base transition-all duration-200">
                Login
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
