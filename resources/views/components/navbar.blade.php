<aside x-data="{ iconOnly: false }"
       :class="iconOnly ? 'w-20' : 'w-64'"
       class="relative bg-gray-800 h-screen hidden sm:block shadow-xl transition-all duration-300 ease-in-out">
    <!-- Header Sidebar -->
    <div class="px-4 py-6 flex items-center justify-between border-b border-gray-700">
        <a href="{{ route('dashboard') }}"
           class="text-white text-xl font-bold truncate"
           :class="iconOnly ? 'opacity-0 w-0' : 'opacity-100'">
            <span class="text-blue-400">Admin</span> Panel
        </a>
        <button @click="iconOnly = !iconOnly"
                class="p-2 text-gray-400 hover:text-white rounded-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-bars w-5 h-5"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex flex-col mt-4 space-y-1 px-2">
        <a href="{{ route('dashboard') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-3 rounded-lg transition-all"
           :class="iconOnly ? 'px-3 justify-center' : 'px-4'">
            <i class="fas fa-tachometer-alt text-lg w-6 text-center transition-all"
               :class="iconOnly ? '' : 'mr-3 group-hover:text-blue-400'"></i>
            <span :class="iconOnly ? 'hidden' : 'flex-1 group-hover:text-white'">Dashboard</span>
        </a>

        <a href="{{ route('barang.create') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-3 rounded-lg transition-all"
           :class="iconOnly ? 'px-3 justify-center' : 'px-4'">
            <i class="fas fa-file-medical text-lg w-6 text-center"
               :class="iconOnly ? '' : 'mr-3 group-hover:text-green-400'"></i>
            <span :class="iconOnly ? 'hidden' : 'flex-1 group-hover:text-white'">Tambah Barang</span>
        </a>

        <a href="{{ route('laporan.keuangan') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-3 rounded-lg transition-all"
           :class="iconOnly ? 'px-3 justify-center' : 'px-4'">
            <i class="fas fa-calculator text-lg w-6 text-center"
               :class="iconOnly ? '' : 'mr-3 group-hover:text-yellow-400'"></i>
            <span :class="iconOnly ? 'hidden' : 'flex-1 group-hover:text-white'">Keuangan</span>
        </a>

        <a href="{{ route('data-barang') }}"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-3 rounded-lg transition-all"
           :class="iconOnly ? 'px-3 justify-center' : 'px-4'">
            <i class="fas fa-table text-lg w-6 text-center"
               :class="iconOnly ? '' : 'mr-3 group-hover:text-purple-400'"></i>
            <span :class="iconOnly ? 'hidden' : 'flex-1 group-hover:text-white'">Data Barang</span>
        </a>

        <a href="#"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-3 rounded-lg transition-all"
           :class="iconOnly ? 'px-3 justify-center' : 'px-4'">
            <i class="fas fa-user-tie text-lg w-6 text-center"
               :class="iconOnly ? '' : 'mr-3 group-hover:text-pink-400'"></i>
            <span :class="iconOnly ? 'hidden' : 'flex-1 group-hover:text-white'">Anggota</span>
        </a>

        <a href="#"
           class="flex items-center text-gray-300 hover:bg-gray-700 group py-3 rounded-lg transition-all"
           :class="iconOnly ? 'px-3 justify-center' : 'px-4'">
            <i class="fas fa-calendar text-lg w-6 text-center"
               :class="iconOnly ? '' : 'mr-3 group-hover:text-red-400'"></i>
            <span :class="iconOnly ? 'hidden' : 'flex-1 group-hover:text-white'">Calendar</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST"
          class="absolute bottom-0 w-full border-t border-gray-700">
        @csrf
        <button type="submit"
                class="w-full flex items-center text-gray-300 hover:bg-gray-700 py-4 transition-colors"
                :class="iconOnly ? 'justify-center' : 'px-4 space-x-3'">
            <i class="fas fa-sign-out-alt" :class="iconOnly ? '' : 'mr-3'"></i>
            <span :class="iconOnly ? 'hidden' : ''">Logout</span>
        </button>
    </form>
</aside>
