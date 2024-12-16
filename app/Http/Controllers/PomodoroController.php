<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function showPomodoro()
    {
        return view('tasks.pomodoro');
    }
}