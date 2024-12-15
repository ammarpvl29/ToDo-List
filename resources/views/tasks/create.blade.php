<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-6">
        <div class="max-w-lg mx-auto">
            <div class="mb-8 text-center">
                <a href="{{ route('tasks.index') }}" class="absolute left-0 top-6 text-gray-600 hover:text-gray-800 transition-colors duration-300">
                    <i class="fas fa-arrow-left text-2xl"></i>
                </a>
                <h2 class="text-3xl font-bold text-gray-800">Create New Task</h2>
            </div>

            <form 
                method="POST" 
                action="{{ route('tasks.store') }}" 
                class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl"
            >
                @csrf

                <div class="p-8">
                    <div class="mb-6">
                        <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-heading mr-2 text-gray-500"></i>Task Title
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="Title"
                            placeholder="Enter task title"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300 @error('Title') border-red-500 @enderror"
                            value="{{ old('Title') }}"
                            required
                        />
                        @error('Title')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-500"></i>Description
                        </label>
                        <textarea
                            id="description"
                            name="Description"
                            rows="5"
                            placeholder="Describe your task in detail"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300 @error('Description') border-red-500 @enderror"
                            required
                        >{{ old('Description') }}</textarea>
                        @error('Description')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="due_date" class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>Due Date
                        </label>
                        <input
                            type="date"
                            id="due_date"
                            name="DueDate"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300"
                            value="{{ old('DueDate') }}"
                        />
                    </div>

                    <div class="mb-6">
                        <label for="priority" class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-flag mr-2 text-gray-500"></i>Priority
                        </label>
                        <select 
                            name="Priority" 
                            id="priority" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300"
                        >
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold py-3 rounded-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl"
                    >
                        <i class="fas fa-plus mr-2"></i>Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        input:focus, textarea:focus, select:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
    @endpush
</x-layout>

@push('scripts')
    <script src="{{ asset('js/chatbot.js') }}"></script>
@endpush

@include('components.chatbot-sidebar')