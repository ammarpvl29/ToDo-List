<x-layout>
    <div class="bg-gray-100 min-h-screen p-6">
        <div class="max-w-6xl mx-auto">
            @auth
            <div class="text-right">
                <a href="{{ route('user.logout') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">LogOut</a>
            </div>
            @endauth
            <div class="mb-4 text-center">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Task Dashboard</h2>
                <a href="{{ route('tasks.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">Create New Task</a>
            </div>

            @if ($tasks)
                <ul class="mt-4">
                    @foreach ($tasks as $task)
                        <li class="bg-white p-4 rounded-lg shadow-lg mb-4">
                            <h3 class="text-lg font-semibold text-black">{{ $task->Title }}</h3>
                            <p class="text-gray-600">{{ Str::limit($task->Description, 100) }}</p>
                            <div class="mt-4">
                                <a href="{{ route('tasks.show', ['task' => $task->id]) }}" class="bg-gray-800 text-white px-3 py-1 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">View</a>
                                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="bg-gray-800 text-white px-3 py-1 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">Edit</a>
                                <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-800 text-white px-3 py-1 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">Delete</button>
                                </form>
                                @if ($task->Completed)
                                    <span class="px-2 py-1 rounded-md bg-green-500 text-white ml-2">Completed</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-6 p-4">
                    {{-- {{$tasks->links()}} --}}
                </div>
            @else
                <p class="text-gray-600 text-center mt-4">No tasks available.</p>
            @endif
        </div>
    </div>
</x-layout>
