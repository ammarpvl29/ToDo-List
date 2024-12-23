<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\PomodoroController;
use App\Http\Controllers\TaskAnalyticsController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'home'])->name('user.index');
Route::get('/login', [UserController::class, 'login'])->name('user.loginDisplay');
Route::get('/register', [UserController::class, 'registerDisplay'])->name('user.registerDisplay');
Route::post('/login', [UserController::class, 'authenticate'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/archive', [TaskController::class, 'archive'])->name('tasks.archive');
    Route::get('/tasks/analytics', [TaskAnalyticsController::class, 'index'])->name('tasks.analytics');
    Route::get('/tasks/pomodoro', [PomodoroController::class, 'index'])->name('pomodoro.index');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
    Route::resource('tasks', TaskController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');
Route::post('/chatbot/message', [ChatbotController::class, 'handleChatbotRequest'])->name('chatbot.message');
Route::resource('tasks', TaskController::class)->middleware('auth');
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::resource('tasks', 'TaskController');
// });