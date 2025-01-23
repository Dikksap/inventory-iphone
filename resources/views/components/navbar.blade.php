<aside x-data="{ iconOnly: false }" 
       :class="iconOnly ? 'w-16' : 'w-64'" 
       class="relative bg-sidebar h-screen hidden sm:block shadow-xl transition-all duration-300">
    <!-- Tombol Toggle -->
    <div class="p-6 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" 
           class="text-white text-3xl font-semibold uppercase hover:text-gray-300"
           :class="iconOnly ? 'hidden' : ''">
            Admin
        </a>
        <button @click="iconOnly = !iconOnly" 
                class="text-white focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
           :class="iconOnly ? 'justify-center' : ''">
            <i class="fas fa-tachometer-alt" :class="iconOnly ? '' : 'mr-3'"></i>
            <span :class="iconOnly ? 'hidden' : ''">Dashboard</span>
        </a>
        <a href="{{ route('barang.create') }}" 
           class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
           :class="iconOnly ? 'justify-center' : ''">
            <i class="fas fa-file-medical" :class="iconOnly ? '' : 'mr-3'"></i>
            <span :class="iconOnly ? 'hidden' : ''">Tambah Barang</span>
        </a>
        <a href="{{ route('laporan.keuangan') }}" 
           class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
           :class="iconOnly ? 'justify-center' : ''">
            <i class="fas fa-calculator" :class="iconOnly ? '' : 'mr-3'"></i>
            <span :class="iconOnly ? 'hidden' : ''">Keuangan</span>
        </a>
        <a href="{{ route('data-barang') }}" 
           class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
           :class="iconOnly ? 'justify-center' : ''">
            <i class="fas fa-table" :class="iconOnly ? '' : 'mr-3'"></i>
            <span :class="iconOnly ? 'hidden' : ''">Data Barang</span>
        </a>
        <a href="" 
           class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
           :class="iconOnly ? 'justify-center' : ''">
            <i class="fas fa-user-tie" :class="iconOnly ? '' : 'mr-3'"></i>
            <span :class="iconOnly ? 'hidden' : ''">Anggota</span>
        </a>
        <a href="" 
           class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
           :class="iconOnly ? 'justify-center' : ''">
            <i class="fas fa-calendar" :class="iconOnly ? '' : 'mr-3'"></i>
            <span :class="iconOnly ? 'hidden' : ''">Calendar</span>
        </a>
    </nav>
    <form action="{{ route('logout') }}" method="POST" 
          class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
        @csrf
        <button type="submit" :class="iconOnly ? 'text-xs' : ''">Logout</button>
    </form>
</aside>
