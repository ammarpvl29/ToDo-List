<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskAnalyticsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $timeRange = request('timeRange', 7); // Default to 7 days
        $startDate = Carbon::now()->subDays($timeRange);
        
        // Get total tasks and completed tasks
        $totalTasks = Task::where('user_id', $userId)
                         ->where('created_at', '>=', $startDate)
                         ->count();
                         
        $completedTasks = Task::where('user_id', $userId)
                             ->where('created_at', '>=', $startDate)
                             ->where('Completed', true)
                             ->count();
                             
        // Calculate completion rate
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 1) : 0;

        // Calculate average completion time
        $avgCompletionTime = Task::where('user_id', $userId)
            ->where('Completed', true)
            ->where('created_at', '>=', $startDate)
            ->whereNotNull('completed_at')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(DAY, created_at, completed_at)) as avg_days'))
            ->first()
            ->avg_days ?? 0;

        // Get tasks by category
        $tasksByCategory = Task::where('user_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->orderByDesc('count')
            ->get();

        // Get daily completions
        $dailyCompletions = Task::where('user_id', $userId)
            ->where('Completed', true)
            ->where('created_at', '>=', $startDate)
            ->select(DB::raw('DATE(completed_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('tasks.analytics', compact(
            'completionRate',
            'totalTasks',
            'completedTasks',
            'avgCompletionTime',
            'tasksByCategory',
            'dailyCompletions',
            'timeRange'
        ));
    }
}