<x-layout>
    <!-- Register Section -->
    <div class="bg-gradient-to-br from-black to-gray-800 min-h-screen flex items-center justify-center px-4 relative overflow-hidden">
        <div class="w-full max-w-md animate-fade-in-up">
            <div class="bg-gray-900 rounded-xl shadow-2xl overflow-hidden">
                <div class="p-8">
                    <h2 class="text-center text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-300 to-gray-500 mb-6 animate-text-glow">
                        Register
                    </h2>

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('user.register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-300 text-sm font-semibold mb-2">Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-300 text-sm font-semibold mb-2">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}"
                                required
                            />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email2" class="block text-gray-300 text-sm font-semibold mb-2">Confirm Email</label>
                            <input
                                type="email"
                                id="email2"
                                name="email_confirmation"
                                class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 @error('email_confirmation') border-red-500 @enderror"
                                value="{{ old('email_confirmation') }}"
                                required
                            />
                            @error('email_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-300 text-sm font-semibold mb-2">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 @error('password') border-red-500 @enderror"
                                required
                            />
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password2" class="block text-gray-300 text-sm font-semibold mb-2">Confirm Password</label>
                            <input
                                type="password"
                                id="password2"
                                name="password_confirmation"
                                class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 @error('password_confirmation') border-red-500 @enderror"
                                required
                            />
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button 
                                type="submit" 
                                class="w-full bg-gradient-to-r from-gray-600 to-gray-700 text-white text-sm font-semibold py-3 rounded-lg hover:from-gray-500 hover:to-gray-600 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 shadow-lg hover:shadow-xl"
                            >
                                Create Account
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-400 text-sm">
                            Already have an account? 
                            <a href="/login" class="text-gray-300 hover:text-gray-100 font-semibold">
                                Login here
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Decorative Background Elements -->
            <div class="hidden md:block">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gray-700 opacity-50 rounded-full -mr-32 -mt-32 animate-pulse"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-gray-700 opacity-50 rounded-full -ml-32 -mb-32 animate-pulse delay-200"></div>
            </div>
        </div>
        <!-- Parallax Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div class="parallax-bg bg-gradient-to-r from-indigo-600 to-purple-600 opacity-20"></div>
            <div class="parallax-bg bg-gradient-to-r from-blue-600 to-teal-600 opacity-20 delay-200"></div>
        </div>
    </div>

    @push('styles')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes textGlow {
            0%, 100% {
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.5), 0 0 20px rgba(255, 255, 255, 0.3), 0 0 30px rgba(255, 255, 255, 0.2);
            }
            50% {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.7), 0 0 30px rgba(255, 255, 255, 0.5), 0 0 40px rgba(255, 255, 255, 0.3);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }

        .animate-text-glow {
            animation: textGlow 2s infinite alternate;
        }

        .parallax-bg {
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            animation: parallax 10s infinite linear;
        }

        @keyframes parallax {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(50%, 50%);
            }
        }
    </style>
    @endpush
</x-layout>