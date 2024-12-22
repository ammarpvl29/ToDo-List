<x-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-700 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Return Button and Title -->
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('tasks.index') }}" class="flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Return to Tasks
                </a>
                <h1 class="text-3xl font-bold text-white">Task Analytics</h1>
            </div>

            <!-- Time Range Filter -->
            <div class="mb-6 bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 border border-gray-700">
                <form method="GET" action="{{ route('tasks.analytics') }}" class="flex items-center space-x-4">
                    <select name="timeRange" class="rounded-md bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring focus:ring-indigo-400 focus:ring-opacity-50">
                        <option value="7" {{ $timeRange == 7 ? 'selected' : '' }}>Last 7 days</option>
                        <option value="30" {{ $timeRange == 30 ? 'selected' : '' }}>Last 30 days</option>
                        <option value="90" {{ $timeRange == 90 ? 'selected' : '' }}>Last 90 days</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-300 shadow-md hover:shadow-lg">
                        Apply Filter
                    </button>
                </form>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Completion Rate -->
                <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 border border-gray-700 transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold text-gray-300 mb-2">Completion Rate</h3>
                    <div class="text-3xl font-bold text-indigo-400">{{ $completionRate }}%</div>
                    <p class="text-gray-400">{{ $completedTasks }} of {{ $totalTasks }} tasks completed</p>
                </div>

                <!-- Average Completion Time -->
                <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 border border-gray-700 transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold text-gray-300 mb-2">Avg. Completion Time</h3>
                    <div class="text-3xl font-bold text-green-400">{{ round($avgCompletionTime, 1) }} days</div>
                    <p class="text-gray-400">Average time to complete tasks</p>
                </div>

                <!-- Total Tasks -->
                <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 border border-gray-700 transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold text-gray-300 mb-2">Total Tasks</h3>
                    <div class="text-3xl font-bold text-purple-400">{{ $totalTasks }}</div>
                    <p class="text-gray-400">Tasks in selected period</p>
                </div>
            </div>

            <!-- Tasks by Category -->
            <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 mb-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-gray-300 mb-4">Tasks by Category</h3>
                <div class="space-y-4">
                    @foreach($tasksByCategory as $category)
                    <div class="border-b border-gray-700 pb-3">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-300">{{ ucfirst($category->category) }}</span>
                            <div class="flex items-center space-x-2">
                                <span class="font-semibold text-gray-300">{{ $category->count }}</span>
                                <span class="text-sm text-gray-400">({{ round(($category->count / $totalTasks) * 100) }}%)</span>
                            </div>
                        </div>
                        <div class="flex gap-0.5">
                            @for($i = 0; $i < 10; $i++)
                                @if($i < round(($category->count / $totalTasks) * 10))
                                    <div class="h-2 flex-1 bg-indigo-500 rounded-sm"></div>
                                @else
                                    <div class="h-2 flex-1 bg-gray-600 rounded-sm"></div>
                                @endif
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Daily Completions -->
            <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-gray-300 mb-4">Daily Completions</h3>
                <div class="space-y-2">
                    @foreach($dailyCompletions as $daily)
                    <div class="flex justify-between items-center border-b border-gray-700 pb-2">
                        <span class="text-gray-300">{{ Carbon\Carbon::parse($daily->date)->format('M d, Y') }}</span>
                        <span class="font-semibold px-3 py-1 bg-indigo-900 text-indigo-200 rounded-full">{{ $daily->count }} tasks</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>