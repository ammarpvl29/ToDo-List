<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Task;

class ProductivityMetricsService
{
    public function calculateMetrics($userId)
    {
        $tasks = Task::where('user_id', $userId);
        
        return [
            'avgCompletionTime' => $this->calculateAverageCompletionTime($tasks),
            'tasksThisWeek' => $this->getTasksThisWeek($tasks),
            'productivityScore' => $this->calculateProductivityScore($tasks),
        ];
    }

    private function calculateAverageCompletionTime($tasks)
    {
        $completedTasks = $tasks->where('completed', true)->get();
        
        if ($completedTasks->isEmpty()) {
            return 0;
        }

        $totalDays = 0;
        foreach ($completedTasks as $task) {
            $created = Carbon::parse($task->created_at);
            $completed = Carbon::parse($task->completed_at);
            $totalDays += $created->diffInDays($completed);
        }

        return number_format($totalDays / $completedTasks->count(), 1);
    }

    private function getTasksThisWeek($tasks)
    {
        return $tasks->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
    }

    private function calculateProductivityScore($tasks)
    {
        $allTasks = $tasks->get();
        
        if ($allTasks->isEmpty()) {
            return 0;
        }

        $completedTasks = $allTasks->where('completed', true)->count();
        $totalTasks = $allTasks->count();
        $completionRate = ($completedTasks / $totalTasks) * 100;

        // Factor in completion time
        $avgCompletionTime = $this->calculateAverageCompletionTime($tasks);
        $timeScore = $avgCompletionTime <= 2 ? 100 : (100 - ($avgCompletionTime - 2) * 10);
        $timeScore = max(0, min(100, $timeScore));

        // Calculate final score (50% completion rate, 50% time score)
        $finalScore = ($completionRate * 0.5) + ($timeScore * 0.5);
        
        return round($finalScore);
    }
}