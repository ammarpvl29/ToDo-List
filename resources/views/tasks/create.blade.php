< --- create.blade.php --- >
<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-6">
        <div class="max-w-2xl mx-auto">
            <div class="mb-8 text-center relative">
                <a href="{{ route('tasks.index') }}" class="absolute left-0 top-6 text-gray-600 hover:text-gray-800 transition-colors duration-300">
                    <i class="fas fa-arrow-left text-2xl"></i>
                </a>
                <h2 class="text-3xl font-bold text-gray-800">Create New Task</h2>
                <p class="text-gray-500 mt-2">Fill out all details carefully</p>
            </div>

            <form 
                method="POST" 
                action="{{ route('tasks.store') }}" 
                class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
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

                        <div>
                            <label for="category" class="block text-gray-700 text-sm font-semibold mb-2">
                                <i class="fas fa-tags mr-2 text-gray-500"></i>Task Category
                            </label>
                            <select 
                                name="Category" 
                                id="category" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300"
                            >
                                <option value="work">Work</option>
                                <option value="personal">Personal</option>
                                <option value="study">Study</option>
                                <option value="health">Health</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
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

                    <div class="grid grid-cols-3 gap-4">
                        <div>
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

                        <div>
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

                        <div>
                            <label for="estimated_time" class="block text-gray-700 text-sm font-semibold mb-2">
                                <i class="fas fa-clock mr-2 text-gray-500"></i>Estimated Time
                            </label>
                            <select 
                                name="EstimatedTime" 
                                id="estimated_time" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition duration-300"
                            >
                                <option value="15">15 minutes</option>
                                <option value="30">30 minutes</option>
                                <option value="60">1 hour</option>
                                <option value="120">2 hours</option>
                                <option value="240">4 hours</option>
                                <option value="480">8 hours</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="subtasks" class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-list-ul mr-2 text-gray-500"></i>Subtasks
                        </label>
                        <div id="subtasks-container">
                            <div class="flex mb-2">
                                <input 
                                    type="text" 
                                    name="Subtasks[]" 
                                    placeholder="Enter subtask" 
                                    class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg mr-2"
                                />
                                <button type="button" class="remove-subtask text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button 
                            type="button" 
                            id="add-subtask" 
                            class="mt-2 text-blue-500 hover:text-blue-700 flex items-center"
                        >
                            <i class="fas fa-plus mr-2"></i>Add Subtask
                        </button>
                    </div>

                    <div class="mb-6">
                        <label for="attachments" class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-paperclip mr-2 text-gray-500"></i>Attachments
                        </label>
                        <input 
                            type="file" 
                            name="Attachments[]" 
                            multiple 
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                        />
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-share-alt mr-2 text-gray-500"></i>Share Task
                        </label>
                        <div class="flex space-x-2">
                            <input 
                                type="email" 
                                name="SharedWith" 
                                placeholder="Enter email to share" 
                                class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                            />
                            <button 
                                type="button" 
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"
                            >
                                Share
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">
                            <i class="fas fa-bell mr-2 text-gray-500"></i>Reminders
                        </label>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="email_reminder" 
                                    name="EmailReminder" 
                                    class="mr-2"
                                />
                                <label for="email_reminder" class="text-gray-700">Email</label>
                            </div>
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="sms_reminder" 
                                    name="SMSReminder" 
                                    class="mr-2"
                                />
                                <label for="sms_reminder" class="text-gray-700">SMS</label>
                            </div>
                            <input 
                                type="datetime-local" 
                                name="ReminderTime" 
                                class="px-4 py-2 border-2 border-gray-200 rounded-lg"
                            />
                        </div>
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

    @push('scripts')
    <script>
        document.getElementById('add-subtask').addEventListener('click', function() {
            const container = document.getElementById('subtasks-container');
            const newSubtask = document.createElement('div');
            newSubtask.className = 'flex mb-2';
            newSubtask.innerHTML = `
                <input 
                    type="text" 
                    name="Subtasks[]" 
                    placeholder="Enter subtask" 
                    class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg mr-2"
                />
                <button type="button" class="remove-subtask text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(newSubtask);

            // Add event listener to new remove button
            newSubtask.querySelector('.remove-subtask').addEventListener('click', function() {
                container.removeChild(newSubtask);
            });
        });
    </script>
    @endpush
</x-layout>