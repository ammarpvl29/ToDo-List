<x-layout>
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-gray-900 to-gray-700 shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center animate-slide-in-top">
            <div class="text-white text-2xl font-bold tracking-wider">
                To-DoIT
            </div>
            <div class="space-x-4">
                <a href="/login" class="text-white bg-gray-800 bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-full transition duration-300 ease-in-out">
                    Login
                </a>
                <a href="/register" class="text-white bg-gray-800 bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-full transition duration-300 ease-in-out">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-black to-gray-800 min-h-screen flex items-center relative overflow-hidden">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center animate-fade-in-up">
                <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-300 to-gray-500 mb-4 animate-text-glow">
                    To-DoIT
                </h1>
                <p class="text-xl text-gray-300 mb-8 animate-fade-in-up delay-200">
                    Streamline Your Productivity, Simplify Your Life
                </p>

                <!-- Feature Highlights -->
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 animate-fade-in-up delay-300">
                        <i class="fas fa-list-check text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2 text-gray-200">Organize Tasks</h3>
                        <p class="text-gray-400">Easily create and manage your daily tasks</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 animate-fade-in-up delay-400">
                        <i class="fas fa-clock text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2 text-gray-200">Track Progress</h3>
                        <p class="text-gray-400">Monitor your productivity with ease</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 animate-fade-in-up delay-500">
                        <i class="fas fa-chart-line text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2 text-gray-200">Boost Efficiency</h3>
                        <p class="text-gray-400">Improve your workflow and time management</p>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="flex justify-center space-x-4">
                    <a href="/register" class="bg-gray-700 text-white px-8 py-3 rounded-full hover:bg-gray-600 transition duration-300 shadow-lg hover:shadow-xl animate-pulse">
                        Get Started
                    </a>
                    <a href="/login" class="bg-gray-800 text-white px-8 py-3 rounded-full hover:bg-gray-700 transition duration-300 border border-gray-600 animate-pulse delay-100">
                        Log In
                    </a>
                </div>
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

        @keyframes slideInTop {
            from {
                opacity: 0;
                transform: translateY(-100%);
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

        .animate-slide-in-top {
            animation: slideInTop 1s ease-out;
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