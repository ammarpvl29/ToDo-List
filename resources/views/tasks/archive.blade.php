<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-black to-gray-800 p-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8 animate-slide-in-top">
                <div class="flex space-x-4">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Tasks
                    </a>
                </div>
            </div>

            <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-white animate-text-glow">Archived Tasks</h2>
                        <div class="flex space-x-3">
                            <button class="px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center animate-pulse">
                                <i class="fas fa-file-export mr-2"></i>Export Archive
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if ($archivedTasks && $archivedTasks->count() > 0)
                        <div class="space-y-4">
                            @foreach ($archivedTasks as $task)
                                <div class="bg-gray-800 border-l-4 border-green-500 p-4 rounded-lg hover:shadow-md transition-all duration-300 animate-fade-in-up">
                                    <div class="flex justify-between items-center">
                                        <div class="flex-grow">
                                            <div class="flex items-center space-x-3">
                                                <h4 class="text-lg font-semibold text-gray-200">{{ $task->Title }}</h4>
                                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                                    Completed {{ $task->completed_at ? $task->completed_at->diffForHumans() : 'Date unknown' }}
                                                </span>
                                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                                                    {{ ucfirst($task->priority) }} Priority
                                                </span>
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                                    {{ ucfirst($task->category) }}
                                                </span>
                                            </div>
                                            <p class="text-gray-400 text-sm mt-2">{{ $task->Description }}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete this archived task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete Task">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-800 rounded-lg animate-fade-in-up">
                            <i class="fas fa-archive text-6xl text-gray-300 mb-4"></i>
                            <p class="text-xl text-gray-400">No archived tasks available.</p>
                            <a href="{{ route('tasks.index') }}" class="mt-4 inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                                Return to Active Tasks
                            </a>
                        </div>
                    @endif
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