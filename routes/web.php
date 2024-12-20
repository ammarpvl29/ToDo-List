<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\PomodoroController;
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
Route::resource('tasks', TaskController::class)->middleware('auth');
Route::post('/chatbot/send', [App\Http\Controllers\ChatbotController::class, 'sendMessage'])->name('chatbot.send');
Route::get('/tasks/pomodoro', [PomodoroController::class, 'showPomodoro'])->name('pomodoro.index');
Route::get('/debug-pomodoro', function() {
    return 'Pomodoro Debug Route Works!';
});
Route::post('/chatbot/message', [ChatbotController::class, 'handleChatbotRequest'])
    ->name('chatbot.message');
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::resource('tasks', 'TaskController');
// });