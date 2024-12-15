<x-layout>
    <!-- Register Section -->
    <div class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                <div class="p-8">
                    <h2 class="text-center text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-6">
                        Register
                    </h2>

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('user.register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}"
                                required
                            />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email2" class="block text-gray-700 text-sm font-semibold mb-2">Confirm Email</label>
                            <input
                                type="email"
                                id="email2"
                                name="email_confirmation"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email_confirmation') border-red-500 @enderror"
                                value="{{ old('email_confirmation') }}"
                                required
                            />
                            @error('email_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror"
                                required
                            />
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password2" class="block text-gray-700 text-sm font-semibold mb-2">Confirm Password</label>
                            <input
                                type="password"
                                id="password2"
                                name="password_confirmation"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password_confirmation') border-red-500 @enderror"
                                required
                            />
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button 
                                type="submit" 
                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 shadow-lg hover:shadow-xl"
                            >
                                Create Account
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600 text-sm">
                            Already have an account? 
                            <a href="/login" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                Login here
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Decorative Background Elements -->
            <div class="hidden md:block">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 opacity-50 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-100 opacity-50 rounded-full -ml-32 -mb-32"></div>
            </div>
        </div>
    </div>
</x-layout>