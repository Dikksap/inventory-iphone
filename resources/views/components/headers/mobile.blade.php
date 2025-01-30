<header x-data="{ isOpen: false }" class="w-full bg-gray-800 py-4 px-4 sm:hidden border-b border-gray-700">
    <div class="flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="text-white text-lg font-bold truncate">
            <span class="text-blue-400">Admin</span> Panel
        </a>
        <button @click="isOpen = !isOpen"
                class="p-2 text-gray-400 hover:text-white rounded-lg hover:bg-gray-700 transition-colors">
            <i x-show="!isOpen" class="fas fa-bars w-5 h-5"></i>
            <i x-show="isOpen" class="fas fa-times w-5 h-5"></i>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <nav x-show="isOpen"
         x-transition:enter="transition transform ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition transform ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="flex flex-col mt-3 space-y-1">

        <a href="{{ route('dashboard') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-2.5 px-3 rounded-lg transition-all">
            <i class="fas fa-tachometer-alt text-lg w-6 text-center group-hover:text-blue-400"></i>
            <span class="ml-2 group-hover:text-white">Dashboard</span>
        </a>

        <a href="{{ route('data-barang') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-2.5 px-3 rounded-lg transition-all">
            <i class="fas fa-table text-lg w-6 text-center group-hover:text-purple-400"></i>
            <span class="ml-2 group-hover:text-white">Data Barang</span>
        </a>

        <a href="{{ route('barang.create') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-2.5 px-3 rounded-lg transition-all">
            <i class="fas fa-file-medical text-lg w-6 text-center group-hover:text-green-400"></i>
            <span class="ml-2 group-hover:text-white">Tambah Barang</span>
        </a>

        <a href="{{ route('laporan.keuangan') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-2.5 px-3 rounded-lg transition-all">
            <i class="fas fa-calculator text-lg w-6 text-center group-hover:text-yellow-400"></i>
            <span class="ml-2 group-hover:text-white">Keuangan</span>
        </a>

        <a href="#"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-2.5 px-3 rounded-lg transition-all">
            <i class="fas fa-calendar text-lg w-6 text-center group-hover:text-red-400"></i>
            <span class="ml-2 group-hover:text-white">Calendar</span>
        </a>

        <a href="#"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-2.5 px-3 rounded-lg transition-all">
            <i class="fas fa-user-tie text-lg w-6 text-center group-hover:text-pink-400"></i>
            <span class="ml-2 group-hover:text-white">Anggota</span>
        </a>

        <a href="{{ route('profile') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-2.5 px-3 rounded-lg transition-all">
            <i class="fas fa-user text-lg w-6 text-center group-hover:text-blue-400"></i>
            <span class="ml-2 group-hover:text-white">My Account</span>
        </a>

        <form action="{{ route('logout') }}" method="POST"
              class="border-t border-gray-700 pt-2 mt-2">
            @csrf
            <button type="submit"
                    class="w-full flex items-center text-gray-300 hover:bg-gray-700 py-2.5 px-3 rounded-lg transition-all">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center group-hover:text-red-400"></i>
                <span class="ml-2 group-hover:text-white">Logout</span>
            </button>
        </form>
    </nav>
</header>
