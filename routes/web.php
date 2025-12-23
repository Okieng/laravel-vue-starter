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
        'feeds' => \App\Models\Feed::with('user')->latest()->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('feed', [\App\Http\Controllers\FeedController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('feed.store');

Route::resource('employees', \App\Http\Controllers\EmployeeController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
