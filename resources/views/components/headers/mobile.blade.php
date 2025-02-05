<!-- resources/views/partials/mobile-nav.blade.php -->
<style>
    [x-cloak] { display: none !important; }
</style>

<header x-data="{ isOpen: false }" class="md:hidden fixed bottom-0 left-0 right-0 bg-gray-900/80 backdrop-blur border-t border-gray-700">
    <!-- Dropdown Hamburger Menu -->
    <div x-cloak x-show="isOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="absolute bottom-12 left-0 right-0 bg-gray-900/90 border-t border-gray-700 z-10">
        <nav class="flex flex-col text-center">
            <!-- Laporan Keuangan -->
            <a href="{{ route('laporan.keuangan') }}"
               class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                Keuangan
            </a>
            <!-- Profil -->
            <a href="{{ route('profile') }}"
               class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">
                Profil
            </a>
            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-center text-gray-300 hover:bg-gray-700">
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Bottom Navbar -->
    <nav class="flex justify-between items-center p-2">
        <!-- Tambah Barang -->
        <a href="{{ route('barang.create') }}"
           class="flex flex-col items-center px-2 py-1.5 rounded-lg transition-all text-xs
                  {{ Request::routeIs('barang.create') ? 'bg-slate-500 text-white' : 'text-gray-300 hover:text-white' }}">
            <i class="fas fa-file-medical text-lg w-6 text-center mb-1"></i>
            <span class="hidden md:inline">Tambah</span>
        </a>

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex flex-col items-center px-2 py-1.5 rounded-lg transition-all text-xs
                  {{ Request::routeIs('dashboard') ? 'bg-slate-500 text-white' : 'text-gray-300 hover:text-white' }}">
            <i class="fas fa-tachometer-alt text-lg w-6 text-center mb-1"></i>
            <span class="hidden md:inline">Dashboard</span>
        </a>

        <!-- Data Barang -->
        <a href="{{ route('data-barang') }}"
           class="flex flex-col items-center px-2 py-1.5 rounded-lg transition-all text-xs
                  {{ Request::routeIs('data-barang') ? 'bg-slate-500 text-white' : 'text-gray-300 hover:text-white' }}">
            <i class="fas fa-table text-lg w-6 text-center mb-1"></i>
            <span class="hidden md:inline">Barang</span>
        </a>

        <!-- Hamburger Menu Button -->
        <button @click="isOpen = !isOpen"
                class="flex flex-col items-center px-2 py-1.5 rounded-lg transition-all text-xs text-gray-300 hover:text-white z-50 focus:outline-none">
            <i class="fas fa-bars text-lg w-6 text-center mb-1"></i>
            <span class="hidden md:inline">Menu</span>
        </button>
    </nav>
</header>
