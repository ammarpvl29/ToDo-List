<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\ProductivityMetricsService;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductivityMetricsService $productivityService)
    {
        $user_id = auth()->id();
        $query = Task::where('user_id', $user_id);
    
        // Apply filters...
        if (request('category')) {
            $query->where('Category', request('category'));
        }
    
        if (request('priority')) {
            $query->where('Priority', request('priority'));
        }
    
        if (request('status')) {
            if (request('status') === 'completed') {
                $query->where('Completed', true);
            } elseif (request('status') === 'pending') {
                $query->where('Completed', false);
            }
        }
    
        // Add sorting
        $sort = request('sort', 'created_at');
        $direction = request('direction', 'desc');
        
        switch($sort) {
            case 'due_date':
                $query->orderBy('DueDate', $direction);
                break;
            case 'priority':
                $query->orderBy('Priority', $direction);
                break;
            case 'category':
                $query->orderBy('Category', $direction);
                break;
            default:
                $query->orderBy('created_at', $direction);
        }
    
        // Add search functionality
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('Title', 'like', "%{$search}%")
                  ->orWhere('Description', 'like', "%{$search}%")
                  ->orWhere('Category', 'like', "%{$search}%");
            });
        }
    
        $tasks = $query->latest()->get();
        $metrics = $productivityService->calculateMetrics($user_id);
        
        // Add task statistics
        $statistics = [
            'total' => $tasks->count(),
            'completed' => $tasks->where('Completed', true)->count(),
            'pending' => $tasks->where('Completed', false)->count(),
            'overdue' => $tasks->where('Completed', false)
                              ->where('DueDate', '<', now())
                              ->count(),
            'due_today' => $tasks->where('Completed', false)
                                ->where('DueDate', '>=', now()->startOfDay())
                                ->where('DueDate', '<=', now()->endOfDay())
                                ->count()
        ];
    
        return view("tasks/index", [
            'tasks' => $tasks,
            'metrics' => $metrics,
            'statistics' => $statistics,
            'currentSort' => $sort,
            'currentDirection' => $direction
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tasks/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $formFields = $request->validate([
            "Title" => ["required", "min:6"],
            "Description" => 'required|min:6',
            "Category" => 'nullable|string',
            "Priority" => 'nullable|string|in:low,medium,high',
            "DueDate" => 'nullable|date',
            "EstimatedTime" => 'nullable|integer'
        ]);
    
        $formFields["Completed"] = false;
        $formFields["user_id"] = auth()->id();
        
        // Set defaults if not provided
        $formFields["Category"] = $formFields["Category"] ?? 'general';
        $formFields["Priority"] = $formFields["Priority"] ?? 'medium';
    
        Task::create($formFields);
        return redirect('/tasks')->with('message', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
 
        return view('tasks/view', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view("tasks/edit", ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, "Unauthorized Action");
        }
    
        $formfields = $request->validate([
            "Title" => ["required", "min:6"],
            "Description" => 'required|min:6',
        ]);
    
        // Check if the task is being marked as completed
        $wasCompleted = $task->Completed;
        $isNowCompleted = $request->has('Completed');
    
        // Update the completion status
        $formfields["Completed"] = $isNowCompleted;
        
        // Update completed_at timestamp
        if (!$wasCompleted && $isNowCompleted) {
            $formfields["completed_at"] = now();
        } elseif (!$isNowCompleted) {
            $formfields["completed_at"] = null;
        }
    
        $task->update($formfields);
    
        return redirect('/tasks')->with('message', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, "Unauthorized Action");
        }
 
        $task->delete();

        return redirect('/tasks')->with('message', 'Tasks deleted successfully!');

    }

    public function archive()
    {
        $archivedTasks = Task::where('user_id', auth()->id())
            ->where('Completed', true)
            ->whereNotNull('completed_at')
            ->orderBy('completed_at', 'desc')
            ->get();
    
        // Add this for debugging
        Log::info('Archived tasks query:', [
            'user_id' => auth()->id(),
            'count' => $archivedTasks->count(),
            'tasks' => $archivedTasks->toArray()
        ]);
    
        return view('tasks.archive', compact('archivedTasks'));
    }

    public function toggleComplete(Task $task)
    {
        $task->update(['Completed' => !$task->Completed]);
        return back();
    }
}
