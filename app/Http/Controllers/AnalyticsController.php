<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $timeRange = $request->input('timeRange', 30); // Default to 30 days
        $endDate = now();
        $startDate = $endDate->copy()->subDays($timeRange);

        $tasks = Task::whereBetween('created_at', [$startDate, $endDate])
                     ->where('user_id', auth()->id())
                     ->get();

        return view('tasks.analytics', [
            'completionRate' => $this->calculateCompletionRate($tasks),
            'avgCompletionTime' => $this->calculateAvgCompletionTime($tasks),
            'taskVolume' => $tasks->count(),
            'productivityScore' => $this->calculateProductivityScore($tasks),
            'completionTrendLabels' => $this->getCompletionTrendLabels($startDate, $endDate),
            'completionTrendData' => $this->getCompletionTrendData($tasks, $startDate, $endDate),
            'categoryLabels' => $this->getCategoryLabels($tasks),
            'categoryData' => $this->getCategoryData($tasks),
            'mostProductiveDay' => $this->getMostProductiveDay($tasks),
            'peakHours' => $this->getPeakHours($tasks),
            'avgDailyTasks' => $this->getAvgDailyTasks($tasks),
            'taskBreakdown' => $this->getTaskBreakdown($tasks),
            'totalTasks' => $tasks->count(),
        ]);
    }

    private function calculateCompletionRate($tasks)
    {
        if ($tasks->isEmpty()) {
            return 0;
        }
        
        $completedTasks = $tasks->where('Completed', true)->count();
        return round(($completedTasks / $tasks->count()) * 100, 1);
    }

    private function calculateAvgCompletionTime($tasks)
    {
        $completedTasks = $tasks->whereNotNull('completed_at');
        
        if ($completedTasks->isEmpty()) {
            return 0;
        }

        $totalDays = $completedTasks->sum(function ($task) {
            $created = Carbon::parse($task->created_at);
            $completed = Carbon::parse($task->completed_at);
            return $created->diffInDays($completed);
        });

        return round($totalDays / $completedTasks->count(), 1);
    }

    private function calculateProductivityScore($tasks)
    {
        if ($tasks->isEmpty()) {
            return 0;
        }

        $completionRate = $this->calculateCompletionRate($tasks);
        $avgCompletionTime = $this->calculateAvgCompletionTime($tasks);
        
        // Simple scoring algorithm
        $timeScore = max(0, 100 - ($avgCompletionTime * 10)); // Lower time is better
        
        return round(($completionRate + $timeScore) / 2);
    }

    private function getCompletionTrendLabels($startDate, $endDate)
    {
        $labels = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $labels[] = $currentDate->format('M d');
            $currentDate->addDay();
        }

        return $labels;
    }

    private function getCompletionTrendData($tasks, $startDate, $endDate)
    {
        $data = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $completedCount = $tasks->where('completed_at', '>=', $currentDate->startOfDay())
                                  ->where('completed_at', '<=', $currentDate->endOfDay())
                                  ->count();
            $data[] = $completedCount;
            $currentDate->addDay();
        }

        return $data;
    }

    private function getCategoryLabels($tasks)
    {
        return $tasks->pluck('category')->unique()->values()->all();
    }

    private function getCategoryData($tasks)
    {
        $categories = $this->getCategoryLabels($tasks);
        $data = [];

        foreach ($categories as $category) {
            $data[] = $tasks->where('category', $category)->count();
        }

        return $data;
    }

    private function getMostProductiveDay($tasks)
    {
        if ($tasks->isEmpty()) {
            return 'N/A';
        }

        $dayCount = $tasks->where('Completed', true)
            ->groupBy(function ($task) {
                return Carbon::parse($task->completed_at)->format('l');
            })
            ->map->count();

        return $dayCount->keys()->first() ?? 'N/A';
    }

    private function getPeakHours($tasks)
    {
        if ($tasks->isEmpty()) {
            return 'N/A';
        }

        $hourCount = $tasks->where('Completed', true)
            ->groupBy(function ($task) {
                return Carbon::parse($task->completed_at)->format('H');
            })
            ->map->count();

        $peakHour = $hourCount->keys()->first();
        
        if (!$peakHour) {
            return 'N/A';
        }

        return sprintf(
            '%s:00 - %s:00',
            str_pad($peakHour, 2, '0', STR_PAD_LEFT),
            str_pad(($peakHour + 1) % 24, 2, '0', STR_PAD_LEFT)
        );
    }

    private function getAvgDailyTasks($tasks)
    {
        if ($tasks->isEmpty()) {
            return 0;
        }

        $days = $tasks->max('created_at')->diffInDays($tasks->min('created_at')) + 1;
        return round($tasks->count() / $days, 1);
    }

    private function getTaskBreakdown($tasks)
    {
        return [
            'High Priority' => $tasks->where('priority', 'high')->count(),
            'Medium Priority' => $tasks->where('priority', 'medium')->count(),
            'Low Priority' => $tasks->where('priority', 'low')->count(),
            'Completed' => $tasks->where('Completed', true)->count(),
            'Pending' => $tasks->where('Completed', false)->count(),
        ];
    }
}