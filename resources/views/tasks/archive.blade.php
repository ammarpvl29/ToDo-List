<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="flex space-x-4">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Tasks
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-white">Archived Tasks</h2>
                        <div class="flex space-x-3">
                            <button class="px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                                <i class="fas fa-file-export mr-2"></i>Export Archive
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if ($archivedTasks && $archivedTasks->count() > 0)
                        <div class="space-y-4">
                            @foreach ($archivedTasks as $task)
                                <div class="bg-gray-50 border-l-4 border-green-500 p-4 rounded-lg hover:shadow-md transition-all duration-300">
                                    <div class="flex justify-between items-center">
                                        <div class="flex-grow">
                                            <div class="flex items-center space-x-3">
                                                <h4 class="text-lg font-semibold text-gray-800">{{ $task->Title }}</h4>
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
                                            <p class="text-gray-500 text-sm mt-2">{{ $task->Description }}</p>
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
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <i class="fas fa-archive text-6xl text-gray-300 mb-4"></i>
                            <p class="text-xl text-gray-600">No archived tasks available.</p>
                            <a href="{{ route('tasks.index') }}" class="mt-4 inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300">
                                Return to Active Tasks
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>