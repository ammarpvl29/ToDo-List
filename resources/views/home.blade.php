<x-layout>
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-white text-2xl font-bold tracking-wider">
                To-DoIT
            </div>
            <div class="space-x-4">
                <a href="/login" class="text-white bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-full transition duration-300 ease-in-out">
                    Login
                </a>
                <a href="/register" class="text-white bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-full transition duration-300 ease-in-out">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-4">
                    To-DoIT
                </h1>
                <p class="text-xl text-gray-700 mb-8">
                    Streamline Your Productivity, Simplify Your Life
                </p>

                <!-- Feature Highlights -->
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-list-check text-4xl text-indigo-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Organize Tasks</h3>
                        <p class="text-gray-600">Easily create and manage your daily tasks</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-clock text-4xl text-purple-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Track Progress</h3>
                        <p class="text-gray-600">Monitor your productivity with ease</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-chart-line text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Boost Efficiency</h3>
                        <p class="text-gray-600">Improve your workflow and time management</p>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="flex justify-center space-x-4">
                    <a href="/register" class="bg-indigo-600 text-white px-8 py-3 rounded-full hover:bg-indigo-700 transition duration-300 shadow-lg hover:shadow-xl">
                        Get Started
                    </a>
                    <a href="/login" class="bg-white text-indigo-600 px-8 py-3 rounded-full hover:bg-gray-100 transition duration-300 border border-indigo-600">
                        Log In
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>