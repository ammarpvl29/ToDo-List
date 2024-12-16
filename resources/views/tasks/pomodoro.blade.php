<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-6">
        <div class="max-w-4xl mx-auto">
            @auth
            <div class="text-right mb-4">
                <a href="{{ route('tasks.index') }}" class="mr-4 px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Tasks
                </a>
                <a href="{{ route('user.logout') }}" class="px-4 py-2 rounded-full bg-red-500 text-white hover:bg-red-600 transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                </a>
            </div>
            @endauth

            <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-white">Pomodoro Timer</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <!-- Pomodoro Timer Content Goes Here -->
                        <div id="pomodoro-container" class="text-center">
                            <div id="timer" class="text-6xl font-bold text-gray-800 mb-6">
                                25:00
                            </div>
                            
                            <div class="flex justify-center space-x-4">
                                <button id="start-btn" class="px-6 py-3 bg-green-500 text-white rounded-full hover:bg-green-600 transition-all duration-300">
                                    Start
                                </button>
                                <button id="pause-btn" class="px-6 py-3 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition-all duration-300">
                                    Pause
                                </button>
                                <button id="reset-btn" class="px-6 py-3 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-300">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/pomodoro.js') }}"></script>
    @endpush
</x-layout>