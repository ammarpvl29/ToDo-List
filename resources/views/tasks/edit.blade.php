<x-layout>
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Back to Dashboard
                </a>
                <h2 class="text-3xl font-extrabold text-white">Edit Task Details</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Edit Form (Main Column) -->
                <div class="md:col-span-2 bg-gray-700 rounded-xl shadow-2xl overflow-hidden">
                    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}" class="p-6 md:p-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Task Title
                                </label>
                                <input
                                    type="text"
                                    id="title"
                                    name="Title"
                                    class="mt-1 block w-full bg-gray-600 border border-gray-500 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 @error('Title') border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('Title', $task->Title) }}"
                                    required
                                />
                                @error('Title')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-300 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Priority
                                </label>
                                <select 
                                    id="priority" 
                                    name="Priority" 
                                    class="mt-1 block w-full bg-gray-600 border border-gray-500 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="Low" {{ $task->Priority == 'Low' ? 'selected' : '' }}>Low</option>
                                    <option value="Medium" {{ $task->Priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="High" {{ $task->Priority == 'High' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Detailed Description
                            </label>
                            <textarea
                                id="description"
                                name="Description"
                                rows="5"
                                class="mt-1 block w-full bg-gray-600 border border-gray-500 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 @error('Description') border-red-500 focus:ring-red-500 @enderror"
                                required
                            >{{ old('Description', $task->Description) }}</textarea>
                            @error('Description')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-300 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Due Date
                                </label>
                                <input 
                                    type="date" 
                                    id="due_date" 
                                    name="DueDate" 
                                    value="{{ $task->DueDate ? \Carbon\Carbon::parse($task->DueDate)->format('Y-m-d') : '' }}"
                                    class="mt-1 block w-full bg-gray-600 border border-gray-500 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                />
                            </div>

                            <div class="flex items-center justify-start space-x-4 pt-6">
                                <label for="completed" class="flex items-center text-sm font-medium text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Task Completed
                                </label>
                                <input
                                    type="checkbox"
                                    id="completed"
                                    name="Completed"
                                    {{ $task->Completed ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                />
                            </div>
                        </div>

                        <div class="mt-6">
                            <button 
                                type="submit" 
                                class="w-full inline-flex justify-center items-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1" />
                                </svg>
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Sidebar with Additional Information -->
                <div class="bg-gray-700 rounded-xl shadow-2xl p-6 space-y-6 text-white">
                    <div>
                        <h3 class="text-xl font-bold mb-3 text-blue-400">Task History</h3>
                        <div class="bg-gray-600 rounded-lg p-4">
                            <p class="text-sm"><strong>Created:</strong> {{ $task->created_at->diffForHumans() }}</p>
                            <p class="text-sm"><strong>Last Updated:</strong> {{ $task->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-3 text-blue-400">Quick Actions</h3>
                        <div class="space-y-3">
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                    Delete Task
                                </button>
                            </form>
                            <a href="{{ route('tasks.duplicate', $task->id) }}" class="block w-full bg-green-600 text-white text-center px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                Duplicate Task
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

@push('scripts')
    <script src="{{ asset('js/chatbot.js') }}"></script>
@endpush

@include('components.chatbot-sidebar')