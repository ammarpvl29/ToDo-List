<x-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 p-6">
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
                        <a href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-circle text-gray-600 text-2xl"></i>
                        </a>
                    </div>
                    <a href="{{ route('user.logout') }}" class="px-4 py-3 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                    </a>
                </div>
            </div>
            @endauth

            <!-- Filter Section -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4" x-data="{ showFilters: false }">
                    <button 
                        @click="showFilters = !showFilters"
                        class="px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300 flex items-center justify-center"
                    >
                        <i class="fas fa-filter mr-2"></i>
                        <span x-text="showFilters ? 'Hide Filters' : 'Show Filters'"></span>
                    </button>
                    
                    <form action="{{ route('tasks.index') }}" method="GET" class="md:col-span-3" x-show="showFilters">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <select name="category" class="px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600">
                                <option value="">All Categories</option>
                                <option value="work" {{ request('category') === 'work' ? 'selected' : '' }}>Work</option>
                                <option value="personal" {{ request('category') === 'personal' ? 'selected' : '' }}>Personal</option>
                                <option value="study" {{ request('category') === 'study' ? 'selected' : '' }}>Study</option>
                                <option value="health" {{ request('category') === 'health' ? 'selected' : '' }}>Health</option>
                                <option value="other" {{ request('category') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>

                            <select name="priority" class="px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600">
                                <option value="">All Priorities</option>
                                <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                                <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                            </select>

                            <select name="status" class="px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600">
                                <option value="">All Status</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>

                            <div class="md:col-span-3 flex justify-end space-x-2">
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                    Apply Filters
                                </button>
                                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                                    Clear Filters
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


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
                        <a href="{{ route('tasks.archive') }}" class="w-full px-4 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <i class="fas fa-archive mr-2"></i>View Archive
                        </a>
                    </div>
                </div>
            </div>


            <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-white">Task Dashboard</h2>
                        <a href="{{ route('tasks.create') }}" class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                            <i class="fas fa-plus mr-2"></i>Create New Task
                        </a>
                    </div>
                </div>
                <div class="p-6">
    @if ($tasks && $tasks->count() > 0)
        <div class="space-y-6" x-data="{ editingTaskId: null }">
            @foreach ($tasks as $task)
                <div 
                    class="bg-gray-50 border-l-4 {{ $task->Completed ? 'border-green-500' : ($task->Priority === 'high' ? 'border-red-500' : ($task->Priority === 'medium' ? 'border-yellow-500' : 'border-blue-500')) }} p-6 rounded-lg hover:shadow-md transition-all duration-300 group relative"
                    x-data="{ isEditing: false, showDetails: false }"
                >
                    <!-- Task Header -->
                    <div class="flex justify-between items-start">
                        <div class="flex-grow">
                            <div class="flex items-center space-x-3 mb-2">
                                <!-- Completion Checkbox -->
                                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input 
                                        type="checkbox" 
                                        {{ $task->Completed ? 'checked' : '' }}
                                        onChange="this.form.submit()"
                                        class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                    >
                                </form>
                                
                                <h4 class="text-xl font-semibold text-gray-800 {{ $task->Completed ? 'line-through text-gray-500' : '' }}">
                                    {{ $task->Title }}
                                </h4>
                                
                                <div class="space-x-2 flex items-center">
                                    <!-- Priority Badge -->
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $task->Priority === 'high' ? 'bg-red-100 text-red-800' : 
                                        ($task->Priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 
                                            'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst($task->Priority) }}
                                    </span>

                                    <!-- Category Badge -->
                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                        {{ ucfirst($task->Category) }}
                                    </span>

                                    <!-- Due Date -->
                                    @if($task->DueDate)
                                        <span class="text-sm text-gray-600">
                                            {{ $task->getTimeRemaining() }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <button 
                                @click="showDetails = !showDetails"
                                class="text-gray-500 hover:text-gray-700 transition-colors"
                            >
                                <i class="fas" :class="showDetails ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <button 
                                @click="isEditing = true" 
                                class="text-blue-500 hover:text-blue-700 transition-colors"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Task Details (Expandable) -->
                    <div x-show="showDetails" x-collapse>
                        <div class="mt-4 space-y-4">
                            <!-- Description -->
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <h5 class="font-semibold text-gray-700 mb-2">Description</h5>
                                <p class="text-gray-600">{{ $task->Description }}</p>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <!-- Due Date -->
                                @if($task->DueDate)
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <div class="text-sm text-gray-500">Due Date</div>
                                    <div class="font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($task->DueDate)->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm {{ \Carbon\Carbon::parse($task->DueDate)->isPast() ? 'text-red-500' : 'text-green-500' }}">
                                        {{ \Carbon\Carbon::parse($task->DueDate)->diffForHumans() }}
                                    </div>
                                </div>
                                @endif

                                <!-- Estimated Time -->
                                @if($task->EstimatedTime)
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <div class="text-sm text-gray-500">Time Estimate</div>
                                    <div class="font-semibold text-gray-800">
                                        @if($task->EstimatedTime >= 60)
                                            {{ floor($task->EstimatedTime / 60) }}h 
                                            {{ $task->EstimatedTime % 60 }}m
                                        @else
                                            {{ $task->EstimatedTime }}m
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <!-- Created Date -->
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <div class="text-sm text-gray-500">Created</div>
                                    <div class="font-semibold text-gray-800">
                                        {{ $task->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $task->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <!-- Attachments -->
                                @if($task->Attachments && count($task->Attachments) > 0)
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <div class="text-sm text-gray-500">Attachments</div>
                                    <div class="space-y-1 mt-1">
                                        @foreach($task->Attachments as $attachment)
                                        <a href="{{ asset('storage/' . $attachment) }}" 
                                           class="text-blue-500 hover:text-blue-700 text-sm flex items-center">
                                            <i class="fas fa-paperclip mr-2"></i>
                                            <span>{{ basename($attachment) }}</span>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Subtasks -->
                            @if($task->Subtasks && count($task->Subtasks) > 0)
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <h5 class="font-semibold text-gray-700 mb-2">Subtasks</h5>
                                <div class="space-y-2">
                                    @foreach($task->Subtasks as $subtask)
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" class="rounded border-gray-300">
                                        <span class="text-gray-700">{{ $subtask }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                        <!-- Edit Form -->
                        <div x-show="isEditing" class="mt-4">
                            <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="space-y-4">
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
                                        class="rounded text-blue-600 focus:ring-blue-500 mr-2"
                                    >
                                    <label class="text-sm text-gray-700">Mark as Completed</label>
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
        <!-- Alpine Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Alpine Core -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush

    @include('components.chatbot-sidebar')
</x-layout>