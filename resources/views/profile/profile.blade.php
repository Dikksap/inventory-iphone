<x-layouts.index>
    @section('content')
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8 space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-4">
                <h1 class="text-4xl font-bold text-gray-900">User Profile</h1>

                @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg flex justify-between items-center">
                    <div>
                        <p class="text-green-700 font-medium">✅ {{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                            class="text-green-700 hover:text-green-900 ml-4">
                        ✕
                    </button>
                </div>
                @endif
            </div>

            <!-- Profile Section -->
            <div class="flex flex-col md:flex-row gap-8 items-center">
                <!-- Avatar Section -->
                <div class="flex-shrink-0">
                    <div class="relative group">
                        @if($user->gambar)
                            <img src="{{ $user->gambar_url }}"
                                 class="w-40 h-40 rounded-full object-cover border-4 border-blue-100 shadow-lg
                                        hover:border-blue-200 transition-all duration-300">
                        @else
                            <div class="w-40 h-40 rounded-full bg-blue-100 flex items-center justify-center
                                      border-4 border-blue-50 hover:border-blue-100 transition-colors">
                                <span class="text-blue-600 text-xl font-medium">Upload Photo</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- User Info -->
                <div class="space-y-2 text-center md:text-left">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <div class="text-sm mt-2">
                        @if($user->gambar)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full">
                                Profile Photo Available
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full">
                                No Profile Photo
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Details Card -->
            <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                <div class="flex items-center justify-between py-3 px-4 bg-white rounded-lg hover:bg-gray-50 transition-colors">
                    <span class="font-medium text-gray-700">Full Name</span>
                    <span class="text-gray-600">{{ $user->name }}</span>
                </div>
                <div class="flex items-center justify-between py-3 px-4 bg-white rounded-lg hover:bg-gray-50 transition-colors">
                    <span class="font-medium text-gray-700">Email Address</span>
                    <span class="text-gray-600 break-all">{{ $user->email }}</span>
                </div>
            </div>

            <!-- Edit Form -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Name Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-200 transition-all outline-none
                                  @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-200 transition-all outline-none
                                  @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Profile Picture Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                    <div class="flex items-center gap-4">
                        <input type="file" name="gambar"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0 file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @if($user->gambar)
                            <img src="{{ $user->gambar_url }}"
                                 class="w-12 h-12 rounded-full object-cover border border-gray-200">
                        @endif
                    </div>
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6
                               rounded-lg transition-colors duration-300 transform hover:scale-[1.01] z-0">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
    @endsection
</x-layouts.index>
