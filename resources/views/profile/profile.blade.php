<x-layouts.index>
    @section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
            <!-- Title -->
            <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">Profile</h1>

            <!-- Profile Information -->
            <div class="text-center mb-6">
                @if($user->gambar)
                    <img src="{{ $user->gambar_url }}" alt="Profile Picture" class="rounded-full w-32 h-32 mx-auto object-cover border-4 border-blue-500 mb-4">
                @else
                    <div class="w-32 h-32 mx-auto bg-gray-300 rounded-full mb-4 flex items-center justify-center">
                        <span class="text-xl text-white">No Image</span>
                    </div>
                @endif
                <p class="text-xl font-semibold text-gray-700">{{ $user->name }}</p>
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
            <div class="mt-6 text-center">
                @if($user->gambar)
                    <p class="text-green-500">Profile picture is set.</p>
                @else
                    <p class="text-red-500">No profile picture available.</p>
                @endif
            </div>
        </div>
    </div>
    @endsection
</x-layouts.index>
