<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button
            @click="isOpen = !isOpen"
            class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none"
        >
            <img
                src="{{ Auth::user()->gambar_url ?? 'https://via.placeholder.com/150' }}"
                alt="Profile Picture"
                class="object-cover w-full h-full"
            >
        </button>
        <button
            x-show="isOpen"
            @click="isOpen = false"
            class="h-full w-full fixed inset-0 cursor-default"
        ></button>
        <div
            x-show="isOpen"
            class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16"
        >
            <a href="{{ route('profile') }}" class="block px-4 py-2 account-link hover:text-white">Account</a>
            <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 account-link hover:text-white">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>
