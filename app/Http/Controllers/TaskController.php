<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\ProductivityMetricsService;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductivityMetricsService $productivityService)
    {
        $user_id = auth()->id();
        $tasks = Task::where('user_id', $user_id)->get();
        $metrics = $productivityService->calculateMetrics($user_id);
        
        return view("tasks/index", [
            'tasks' => $tasks,
            'metrics' => $metrics
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
        $formfields = $request->validate([
            "Title" => ["required", "min:6"],
            "Description" => 'required|min:6',
        ]);
    
        $formfields["Completed"] = 0;
        $formfields["user_id"] = auth()->id();
        $formfields["completed_at"] = null;
    
        $Task = Task::create($formfields);
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
    
        $wasCompleted = $task->Completed;
        $isNowCompleted = $request->Completed == "on";
    
        $formfields["Completed"] = $isNowCompleted ? 1 : 0;
        $formfields["user_id"] = auth()->id();
        
        // Set completed_at timestamp when task is marked as completed
        if (!$wasCompleted && $isNowCompleted) {
            $formfields["completed_at"] = now();
        } elseif ($wasCompleted && !$isNowCompleted) {
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
}
