{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('https://as1.ftcdn.net/v2/jpg/10/29/40/42/1000_F_1029404210_UGKGVyzLdSKLe4XU2rrQ5pSVIZCrPFnz.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-between min-h-screen text-white">
    <div class="w-full max-w-xs mt-8">
        <div class="flex justify-center mb-4">
            <img src="https://cdn.robotaset.com/assets/tpl/27e0e0c1a3/images/logo.gif" class="h-12" alt="Logo">
        </div>
        <div class="bg-white bg-opacity-20 p-4 rounded-lg">
            <h2 class="text-center mb-4">Silahkan masuk</h2>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf
                <!-- Input Nama Pengguna -->
                <input
                    class="w-full p-2 rounded bg-white text-black"
                    placeholder="Nama Pengguna"
                    type="text"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                />
                <!-- Input Kata Sandi -->
                <div class="relative">
                    <input
                        class="w-full p-2 rounded bg-white text-black"
                        placeholder="Kata Sandi"
                        type="password"
                        id="password"
                        name="password"
                        required
                    />
                    <i class="fas fa-eye absolute right-3 top-3 text-black"></i>
                </div>
                <!-- Tombol Login -->
                <button
                    class="w-full p-2 bg-gray-400 rounded"
                    type="submit"
                >
                    MASUK
                </button>
            </form>

            <!-- Opsional untuk menggunakan Google Login -->
            <div class="flex items-center my-4">
                <hr class="flex-grow border-gray-400"/>
                <span class="mx-2">atau masuk dengan</span>
                <hr class="flex-grow border-gray-400"/>
            </div>
            <button class="w-full p-2 bg-white text-black rounded flex items-center justify-center">
                <img alt="Google Logo" class="mr-2" src="https://placehold.co/20x20"/>
                Sign in with Google
            </button>
        </div>

        <!-- Tombol Gabung Sekarang -->
        <div class="mt-4 text-center">
            <p>Klik disini untuk menjadi anggota</p>
            <button class="w-full p-2 bg-gray-400 rounded">GABUNG SEKARANG</button>
        </div>
    </div>

    <!-- Footer dan Navigasi -->
    <div class="w-full bg-black bg-opacity-50 p-4 flex justify-around">
        <a class="flex flex-col items-center" href="#">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
        <a class="flex flex-col items-center" href="#">
            <i class="fas fa-user"></i>
            <span>Akun Saya</span>
        </a>
        <a class="flex flex-col items-center" href="#">
            <i class="fas fa-tags"></i>
            <span>Promosi</span>
        </a>
        <a class="flex flex-col items-center" href="#">
            <i class="fas fa-comments"></i>
            <span>Live Chat</span>
        </a>
        <a class="flex flex-col items-center" href="#">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>
    </div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Iphone</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="Login Page for Inventory Management System">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex items-center justify-center min-h-screen">

    <div class="relative w-full max-w-lg">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg sm:rounded-3xl"></div>
        <div class="relative px-6 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-12">
            <div class="max-w-md mx-auto">
                <h1 class="text-3xl font-semibold text-center text-gray-700 mb-6">Login Admin</h1>

                @if (session('message'))
                    <div class="text-red-500 text-sm mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="text-red-500 text-sm mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf
                    <div class="relative">
                        <input autocomplete="off" id="email" name="email" type="text" value="{{ old('email') }}" required
                               class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500" placeholder="Email address" />
                        <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                    </div>
                    <div class="relative">
                        <input autocomplete="off" id="password" name="password" type="password" required
                               class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500" placeholder="Password" />
                        <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                    </div>

                    <div class="relative">
                        <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
