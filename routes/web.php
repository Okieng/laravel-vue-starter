<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard', [
        'feeds' => \App\Models\Feed::with(['user', 'comments.user'])
            ->withExists(['likes as is_liked' => function($query) {
                $query->where('user_id', auth()->id());
            }])
            ->latest()
            ->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('chat/{user}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('chat/{user}', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
    Route::get('calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
    Route::post('feed/{feed}/follow', [\App\Http\Controllers\CalendarController::class, 'toggleFollow'])->name('feed.follow');
    Route::post('feed', [\App\Http\Controllers\FeedController::class, 'store'])->name('feed.store');
    Route::post('feed/{feed}/like', [\App\Http\Controllers\LikeController::class, 'toggle'])->name('feed.like');
    Route::post('feed/{feed}/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('feed.comment.store');
    Route::delete('comment/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('feed.comment.destroy');
});

Route::resource('employees', \App\Http\Controllers\EmployeeController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
