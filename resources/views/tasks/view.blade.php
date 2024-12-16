<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-6">
        <div class="max-w-6xl mx-auto">
            @auth
            <div class="flex justify-between items-center mb-8">
                <div class="flex space-x-4">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2 text-sm"></i>Back to Tasks
                    </a>
                    <a href="{{ route('pomodoro.index') }}" class="px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                        <i class="fas fa-clock mr-2 text-sm"></i>Pomodoro Timer
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

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-white">Task Details</h2>
                        <div class="flex space-x-3">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                                <i class="fas fa-edit mr-2"></i>Edit Task
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                                    <i class="fas fa-trash mr-2"></i>Delete Task
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($task)
                    <div class="p-8 space-y-6">
                        <div class="bg-gray-50 border-l-4 {{ $task->Completed ? 'border-green-500' : 'border-blue-500' }} p-6 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $task->Title }}</h3>
                                @if ($task->Completed)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-2 text-green-500"></i>Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-2 text-yellow-500"></i>In Progress
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Description</h4>
                                    <p class="text-gray-600">{{ $task->Description }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-600 mb-1">Created At</h4>
                                        <p class="text-gray-800">{{ $task->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                    @if ($task->Completed)
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-600 mb-1">Completed At</h4>
                                            <p class="text-gray-800">{{ $task->updated_at->format('M d, Y H:i') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <i class="fas fa-tasks text-6xl text-gray-300 mb-4"></i>
                        <p class="text-xl text-gray-600">No task found. It may have been deleted.</p>
                        <a href="{{ route('tasks.index') }}" class="mt-4 inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                            Back to Task List
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/chatbot.js') }}"></script>
    @endpush

    @include('components.chatbot-sidebar')
</x-layout>