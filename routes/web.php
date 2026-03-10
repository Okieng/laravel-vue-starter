<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard', [
        'feeds' => \App\Models\Feed::with(['user', 'comments.user'])
            ->withExists(['likes as is_liked' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->latest()
            ->get(),
        'jabatans' => \App\Models\Jabatan::where('flag_active', 'Y')->get(['idjabatan', 'namajabatan']),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('chat/{user}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('chat/{user}', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
    Route::get('calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::get('task', [\App\Http\Controllers\TaskController::class, 'index'])->name('task');
    Route::get('task-dashboard', [\App\Http\Controllers\TaskController::class, 'dashboard'])->name('task-dashboard');
    Route::post('task-dashboard', [\App\Http\Controllers\TaskController::class, 'store'])->name('task.store');
    Route::post('feed/{feed}/follow', [\App\Http\Controllers\CalendarController::class, 'toggleFollow'])->name('feed.follow');
    Route::post('feed', [\App\Http\Controllers\FeedController::class, 'store'])->name('feed.store');
    Route::post('feed/{feed}/like', [\App\Http\Controllers\LikeController::class, 'toggle'])->name('feed.like');
    Route::post('feed/{feed}/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('feed.comment.store');
    Route::delete('comment/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('feed.comment.destroy');
    Route::post('/conversations/private/{user}', [App\Http\Controllers\ConversationController::class, 'getOrCreatePrivate']);

    Route::get('projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
    Route::post('projects', [\App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');
    Route::post('projects/{project}/view', [\App\Http\Controllers\ProjectController::class, 'trackView'])->name('projects.view');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('employees/knowledge-base', [\App\Http\Controllers\Employees\KnowledgeBaseController::class, 'index'])->name('employees.knowledge-base.index');
    Route::get('employees/knowledge-base/create', [\App\Http\Controllers\Employees\KnowledgeBaseController::class, 'create'])->name('employees.knowledge-base.create');
    Route::get('employees/work-time', [\App\Http\Controllers\Employees\WorkTimeController::class, 'index'])->name('employees.work-time.index');
    Route::get('daily-reports', [\App\Http\Controllers\DailyReportsController::class, 'index'])->name('daily-reports.index');
    Route::resource('employees', \App\Http\Controllers\EmployeeController::class);
});

Route::resource('rooms', \App\Http\Controllers\RoomController::class)
    ->middleware(['auth', 'verified']);

Route::resource('room-bookings', \App\Http\Controllers\RoomBookingController::class)
    ->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/attendance/current', [\App\Http\Controllers\AttendanceController::class, 'current'])->name('attendance.current');
    Route::post('/attendance/check-in', [\App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
    Route::put('/attendance/{attendance}/check-out', [\App\Http\Controllers\AttendanceController::class, 'update'])->name('attendance.update');
    Route::post('/user/theme', [\App\Http\Controllers\ThemeController::class, 'update'])->name('user.theme.update');
});

require __DIR__ . '/settings.php';
