<x-layout>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-6">
        <div class="max-w-4xl mx-auto">
            @auth
            <div class="text-right mb-4">
                <a href="{{ route('pomodoro.index') }}" class="mr-4 px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                    <i class="fas fa-clock mr-2"></i>Pomodoro Timer
                </a>
                <a href="{{ route('user.logout') }}" class="px-4 py-2 rounded-full bg-red-500 text-white hover:bg-red-600 transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                </a>
            </div>
            @endauth

            <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-white">Task Dashboard</h2>
                        <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i>Create New Task
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    @if ($tasks && $tasks->count() > 0)
                        <div class="space-y-4">
                            @foreach ($tasks as $task)
                                <div class="bg-gray-50 border-l-4 {{ $task->Completed ? 'border-green-500' : 'border-gray-300' }} p-4 rounded-lg hover:shadow-md transition-all duration-300 group">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-grow pr-4">
                                            <h3 class="text-xl font-semibold {{ $task->Completed ? 'text-gray-500 line-through' : 'text-gray-800' }}">
                                                {{ $task->Title }}
                                            </h3>
                                            <p class="text-gray-600 mt-1">
                                                {{ Str::limit($task->Description, 100) }}
                                            </p>
                                        </div>
                                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" class="text-blue-500 hover:text-blue-600 p-2 rounded-full hover:bg-blue-50 transition-all">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="text-yellow-500 hover:text-yellow-600 p-2 rounded-full hover:bg-yellow-50 transition-all">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition-all">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3 flex justify-between items-center">
                                        @if ($task->Completed)
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                                Completed
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">
                                                In Progress
                                            </span>
                                        @endif
                                        <span class="text-sm text-gray-500">
                                            Created {{ $task->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <i class="fas fa-tasks text-6xl text-gray-300 mb-4"></i>
                            <p class="text-xl text-gray-600">No tasks available. Let's get started!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    @endpush
</x-layout>

@push('scripts')
    <script src="{{ asset('js/chatbot.js') }}"></script>
@endpush

@include('components.chatbot-sidebar')