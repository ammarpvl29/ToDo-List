<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'Title',
        'Description',
        'Completed',
        'user_id',
        'completed_at',
        'Category',
        'Priority',
        'EstimatedTime',
        'Subtasks'
    ];

    protected $casts = [
        'Completed' => 'boolean',
        'completed_at' => 'datetime',
        'Subtasks' => 'array'
    ];
	
    protected $dates = ['created_at', 'updated_at', 'completed_at'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // Simplified progress method based on completion status only
    public function getProgress()
    {
        return $this->Completed ? 100 : 0;
    }

    // Modified to use priority instead of due date for color coding
    public function getStatusColor()
    {
        if ($this->Completed) {
            return 'bg-green-500';
        }

        // Color based on priority
        switch ($this->Priority) {
            case 'high':
                return 'bg-red-500';
            case 'medium':
                return 'bg-yellow-500';
            case 'low':
                return 'bg-blue-500';
            default:
                return 'bg-gray-500';
        }
    }
}