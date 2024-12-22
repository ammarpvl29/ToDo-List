<x-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-6">
        <div class="max-w-6xl mx-auto">
            @auth
            <div class="flex justify-between items-center mb-8">
                <div class="flex space-x-4">
                    <a href="{{ route('pomodoro.index') }}" class="px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                        <i class="fas fa-clock mr-2 text-sm"></i>Pomodoro Timer
                    </a>
                    <a href="{{ route('tasks.analytics') }}" class="px-4 py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                        <i class="fas fa-chart-bar mr-2 text-sm"></i>Analytics
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white rounded-full p-2 shadow-md">
                        <i class="fas fa-user-circle text-gray-600 text-2xl"></i>
                    </div>
                    <a href="{{ route('user.logout') }}" class="px-4 py-3 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                    </a>
                </div>
            </div>
            @endauth

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:shadow-3xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">Task Overview</h3>
                        <i class="fas fa-tasks text-blue-500 text-xl"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2 border-gray-200">
                            <span class="text-gray-600 font-semibold">Total Tasks</span>
                            <span class="font-bold text-blue-600">{{ $tasks->count() }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2 border-gray-200">
                            <span class="text-gray-600 font-semibold">Completed</span>
                            <span class="font-bold text-green-600">{{ $tasks->where('Completed', true)->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-semibold">Pending</span>
                            <span class="font-bold text-yellow-600">{{ $tasks->where('Completed', false)->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:shadow-3xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">Productivity Metrics</h3>
                        <i class="fas fa-chart-line text-green-500 text-xl"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2 border-gray-200">
                            <span class="text-gray-600 font-semibold">Avg. Task Completion Time</span>
                            <span class="font-bold text-purple-600">{{ $metrics['avgCompletionTime'] }} days</span>
                        </div>
                        <div class="flex justify-between border-b pb-2 border-gray-200">
                            <span class="text-gray-600 font-semibold">Tasks This Week</span>
                            <span class="font-bold text-indigo-600">{{ $metrics['tasksThisWeek'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 font-semibold">Productivity Score</span>
                            <span class="font-bold text-green-600">{{ $metrics['productivityScore'] }}%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:shadow-3xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800">Quick Actions</h3>
                        <i class="fas fa-bolt text-yellow-500 text-xl"></i>
                    </div>
                    <div class="space-y-4">
                        <a href="{{ route('tasks.create') }}" class="w-full px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i>Create New Task
                        </a>
                        <a href="#" class="w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <i class="fas fa-filter mr-2"></i>Filter Tasks
                        </a>
                        <a href="#" class="w-full px-4 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <i class="fas fa-archive mr-2"></i>Archive Tasks
                        </a>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-white">Task Dashboard</h2>
                        <div class="flex space-x-3">
                            <a href="#" class="px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                                <i class="fas fa-file-export mr-2"></i>Export
                            </a>
                            <a href="{{ route('tasks.create') }}" class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                                <i class="fas fa-plus mr-2"></i>Create New Task
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if ($tasks && $tasks->count() > 0)
                        <div class="space-y-4" x-data="{ editingTaskId: null }">
                            @foreach ($tasks as $task)
                                <div 
                                    class="bg-gray-50 border-l-4 {{ $task->Completed ? 'border-green-500' : 'border-blue-500' }} p-4 rounded-lg hover:shadow-md transition-all duration-300 group relative"
                                    x-data="{ isEditing: false }"
                                >
                                    <!-- View Mode -->
                                    <div x-show="!isEditing" class="flex justify-between items-center">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $task->Title }}</h4>
                                            <p class="text-gray-500 text-sm">{{ $task->Description }}</p>
                                        </div>
                                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button 
                                                @click="isEditing = true" 
                                                class="text-blue-500 hover:text-blue-700"
                                                title="Edit Task"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete Task">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Edit Mode -->
                                    <div x-show="isEditing" class="space-y-4">
                                        <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="space-y-3">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                                <input 
                                                    type="text" 
                                                    name="Title" 
                                                    value="{{ $task->Title }}" 
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                                    required
                                                >
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                                <textarea 
                                                    name="Description" 
                                                    rows="3" 
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                                    required
                                                >{{ $task->Description }}</textarea>
                                            </div>

                                            <div class="flex items-center">
                                                <input 
                                                    type="checkbox" 
                                                    name="Completed" 
                                                    {{ $task->Completed ? 'checked' : '' }}
                                                    class="mr-2 rounded text-blue-600 focus:ring-blue-500"
                                                >
                                                <label class="text-sm text-gray-700">Completed</label>
                                            </div>

                                            <div class="flex justify-between">
                                                <button 
                                                    type="submit" 
                                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                                                >
                                                    Update Task
                                                </button>
                                                <button 
                                                    type="button" 
                                                    @click="isEditing = false"
                                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                                                >
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <i class="fas fa-tasks text-6xl text-gray-300 mb-4"></i>
                            <p class="text-xl text-gray-600">No tasks available. Let's get started!</p>
                            <a href="{{ route('tasks.create') }}" class="mt-4 inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                                Create Your First Task
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        input:focus, button:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('js/chatbot.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const taskItems = document.querySelectorAll('.group');
                taskItems.forEach(item => {
                    item.addEventListener('mouseenter', () => {
                        item.classList.add('transform', '-translate-y-1', 'shadow-lg');
                    });
                    item.addEventListener('mouseleave', () => {
                        item.classList.remove('transform', '-translate-y-1', 'shadow-lg');
                    });
                });
            });
        </script>
    @endpush

    @include('components.chatbot-sidebar')
</x-layout>