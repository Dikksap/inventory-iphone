<x-layouts.index>
    @section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full space-y-8">
            <!-- Title -->
            <h1 class="text-3xl font-semibold text-gray-800 text-center">Profile</h1>
            @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <span class="text-green-700">&times;</span>
        </button>
    </div>
@endif

            <!-- Profile Information -->
            <div class="text-center">
                @if($user->gambar)
                    <img src="{{ $user->gambar_url }}" alt="Profile Picture" class="rounded-full w-32 h-32 mx-auto object-cover border-4 border-blue-500">
                @else
                    <div class="w-32 h-32 mx-auto bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-xl text-white">No Image</span>
                    </div>
                @endif
                <p class="mt-4 text-xl font-semibold text-gray-700">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>

            <!-- Profile Details -->
            <div class="space-y-4">
                <div class="flex justify-between text-gray-600">
                    <span class="font-medium">Name:</span>
                    <span>{{ $user->name }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span class="font-medium">Email:</span>
                    <span>{{ $user->email }}</span>
                </div>
            </div>

            <!-- Profile Picture Status -->
            <div class="text-center">
                @if($user->gambar)
                    <p class="text-green-500">Profile picture is set.</p>
                @else
                    <p class="text-red-500">No profile picture available.</p>
                @endif
            </div>

            <!-- Update Form -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700 text-sm font-bold">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label for="gambar" class="block text-gray-700 text-sm font-bold">Profile Picture:</label>
                    <input type="file" id="gambar" name="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-blue-300">
                    @if($user->gambar)
                        <img src="{{ $user->gambar_url }}" alt="Current Profile Picture" class="mt-4 w-24 h-24 object-cover rounded-full">
                    @endif
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-300">Update Profile</button>
            </form>
        </div>
    </div>
    @endsection
</x-layouts.index>
